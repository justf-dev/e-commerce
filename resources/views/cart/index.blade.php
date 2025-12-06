<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

        @if($cart->items->isEmpty())
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h2 class="text-2xl font-semibold mb-2">Your cart is empty</h2>
                <p class="text-gray-600 mb-6">Add some products to get started!</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow">
                        @foreach($cart->items as $item)
                            <div class="p-6 border-b last:border-b-0">
                                <div class="flex gap-4">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/100' }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-24 h-24 object-cover rounded">
                                    
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $item->product->category->name }}</p>
                                        <p class="text-indigo-600 font-bold mt-2">₱{{ number_format($item->price, 2) }}</p>
                                    </div>

                                    <div class="flex flex-col items-end justify-between">
                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                   class="w-16 border rounded px-2 py-1 text-center"
                                                   onchange="this.form.submit()">
                                        </form>

                                        <p class="font-bold">₱{{ number_format($item->getSubtotal(), 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div>
                    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                        <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $cart->getItemCount() }} items)</span>
                                <span class="font-semibold">₱{{ number_format($cart->getTotal(), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold">₱100.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (12%)</span>
                                <span class="font-semibold">₱{{ number_format($cart->getTotal() * 0.12, 2) }}</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold">Total</span>
                                    <span class="text-lg font-bold text-indigo-600">
                                        ₱{{ number_format($cart->getTotal() + 100 + ($cart->getTotal() * 0.12), 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-indigo-700">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('products.index') }}" class="block w-full text-center text-indigo-600 py-3 mt-2 font-medium hover:text-indigo-800">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>