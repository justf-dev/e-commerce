<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Shipping Address -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold mb-4">Shipping Address</h2>

                        @if($addresses->isEmpty())
                            <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-4">
                                <p class="text-sm text-yellow-800">You need to add a shipping address.</p>
                            </div>

                            <div class="space-y-4" x-data="{ showForm: true }">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Full Name *</label>
                                        <input type="text" name="full_name" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Phone *</label>
                                        <input type="tel" name="phone" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1">Address Line 1 *</label>
                                        <input type="text" name="address_line1" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1">Address Line 2</label>
                                        <input type="text" name="address_line2" class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">City *</label>
                                        <input type="text" name="city" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">State/Province *</label>
                                        <input type="text" name="state" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Postal Code *</label>
                                        <input type="text" name="postal_code" required class="w-full border rounded px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Country *</label>
                                        <input type="text" name="country" value="Philippines" class="w-full border rounded px-3 py-2">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($addresses as $address)
                                    <label class="block border rounded p-4 cursor-pointer hover:bg-gray-50 {{ $address->is_default ? 'border-indigo-600 bg-indigo-50' : '' }}">
                                        <input type="radio" name="shipping_address_id" value="{{ $address->id }}" required {{ $address->is_default ? 'checked' : '' }} class="mr-3">
                                        <div class="inline-block">
                                            <p class="font-semibold">{{ $address->full_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                            <p class="text-sm text-gray-600">{{ $address->full_address }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold mb-4">Payment Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center border rounded p-4 cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="cod" checked class="mr-3">
                                <div>
                                    <p class="font-semibold">Cash on Delivery</p>
                                    <p class="text-sm text-gray-600">Pay when you receive your order</p>
                                </div>
                            </label>
                            <label class="flex items-center border rounded p-4 cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="gcash" class="mr-3">
                                <div>
                                    <p class="font-semibold">GCash</p>
                                    <p class="text-sm text-gray-600">Pay securely with GCash</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold mb-4">Order Notes (Optional)</h2>
                        <textarea name="notes" rows="3" placeholder="Special instructions for delivery..." class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                </div>

                <!-- Order Summary -->
                <div>
                    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                        <h2 class="text-xl font-bold mb-4">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            @foreach($cart->items as $item)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span>₱{{ number_format($item->getSubtotal(), 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold">₱{{ number_format($shippingCost, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (12%)</span>
                                <span class="font-semibold">₱{{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold">Total</span>
                                    <span class="text-lg font-bold text-indigo-600">₱{{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 mt-6">
                            Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center text-indigo-600 mt-3 hover:text-indigo-800">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>