<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-800">
                ← Back to Orders
            </a>
        </div>

        <div class="bg-white rounded-lg shadow">
            <!-- Order Header -->
            <div class="p-6 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold">Order #{{ $order->order_number }}</h1>
                        <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                        @if($order->status === 'completed') bg-green-100 text-green-800
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6 border-b">
                <h2 class="font-bold text-lg mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4">
                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/100' }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="w-24 h-24 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-semibold">{{ $item->product_name }}</h3>
                                <p class="text-gray-600 text-sm">₱{{ number_format($item->price, 2) }} × {{ $item->quantity }}</p>
                                <p class="font-semibold text-indigo-600 mt-1">₱{{ number_format($item->subtotal, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="p-6 border-b">
                <h2 class="font-bold text-lg mb-4">Order Summary</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">₱{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-semibold">₱{{ number_format($order->shipping_cost, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax</span>
                        <span class="font-semibold">₱{{ number_format($order->tax, 2) }}</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg text-indigo-600">₱{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping & Payment Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="font-bold text-lg mb-3">Shipping Address</h2>
                    @if($order->shippingAddress)
                        <p class="text-gray-700">{{ $order->shippingAddress->full_name }}</p>
                        <p class="text-gray-700">{{ $order->shippingAddress->phone }}</p>
                        <p class="text-gray-700">{{ $order->shippingAddress->full_address }}</p>
                    @else
                        <p class="text-gray-500">No shipping address</p>
                    @endif
                </div>

                <div>
                    <h2 class="font-bold text-lg mb-3">Payment Information</h2>
                    <p class="text-gray-700">Method: <span class="font-semibold">{{ strtoupper($order->payment_method) }}</span></p>
                    @if($order->payment)
                        <p class="text-gray-700">Status: 
                            <span class="font-semibold
                                @if($order->payment->status === 'completed') text-green-600
                                @elseif($order->payment->status === 'failed') text-red-600
                                @else text-yellow-600
                                @endif">
                                {{ ucfirst($order->payment->status) }}
                            </span>
                        </p>
                    @endif
                </div>
            </div>

            @if($order->notes)
                <div class="p-6 border-t">
                    <h2 class="font-bold text-lg mb-2">Order Notes</h2>
                    <p class="text-gray-700">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>