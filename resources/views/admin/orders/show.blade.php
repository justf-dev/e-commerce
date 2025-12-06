<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-800">
                ← Back to Orders
            </a>
        </div>

        <div class="bg-white rounded-lg shadow">
            <!-- Order Header -->
            <div class="p-6 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold">Order #{{ $order->order_number }}</h1>
                        <p class="text-gray-600">Customer: {{ $order->user->name }}</p>
                        <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                    </div>
                    <div>
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border rounded px-3 py-2">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                Update
                            </button>
                        </form>
                    </div>
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

            <!-- Customer Information -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="font-bold text-lg mb-3">Customer Information</h2>
                    <p class="text-gray-700">Name: {{ $order->user->name }}</p>
                    <p class="text-gray-700">Email: {{ $order->user->email }}</p>
                </div>

                <div>
                    <h2 class="font-bold text-lg mb-3">Shipping Address</h2>
                    @if($order->shippingAddress)
                        <p class="text-gray-700">{{ $order->shippingAddress->full_name }}</p>
                        <p class="text-gray-700">{{ $order->shippingAddress->phone }}</p>
                        <p class="text-gray-700">{{ $order->shippingAddress->full_address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>