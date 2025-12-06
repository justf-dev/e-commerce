<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Category Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
            <p class="text-gray-600">{{ $category->description }}</p>
        </div>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <p class="text-gray-500 text-center py-12">No products found in this category.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                        </a>
                        <div class="p-4">
                            <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="font-semibold text-lg hover:text-indigo-600">
                                {{ $product->name }}
                            </a>
                            <p class="text-indigo-600 font-bold mt-2">₱{{ number_format($product->price, 2) }}</p>
                            @auth
                                @if($product->isInStock())
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 py-2 rounded mt-4">
                                        Out of Stock
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full text-center bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 mt-4">
                                    Login to Buy
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
