<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div>
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/500' }}" 
                     alt="{{ $product->name }}" 
                     class="w-full rounded-lg shadow-lg">
            </div>

            <!-- Product Details -->
            <div>
                <nav class="text-sm mb-4">
                    <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Products</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-indigo-600 hover:underline">
                        {{ $product->category->name }}
                    </a>
                </nav>

                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="text-3xl font-bold text-indigo-600">₱{{ number_format($product->price, 2) }}</span>
                </div>

                <div class="mb-6">
                    @if($product->isInStock())
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            Out of Stock
                        </span>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Description</h3>
                    <p class="text-gray-600">{{ $product->description ?? 'No description available.' }}</p>
                </div>

                @auth
                    @if($product->isInStock())
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex items-center gap-4 mb-4">
                                <label class="font-semibold">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-20 border rounded px-3 py-2">
                            </div>
                            <button type="submit" class="w-full md:w-auto bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">
                        Login to Purchase
                    </a>
                @endauth
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                <img src="{{ $relatedProduct->image ? asset('storage/' . $relatedProduct->image) : 'https://via.placeholder.com/300' }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-48 object-cover rounded-t-lg">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="font-semibold hover:text-indigo-600">
                                    {{ $relatedProduct->name }}
                                </a>
                                <p class="text-indigo-600 font-bold mt-2">₱{{ number_format($relatedProduct->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>