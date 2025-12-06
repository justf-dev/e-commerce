<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to ShopHub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Featured Products Section -->
            @if($featuredProducts->count() > 0)
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Featured Products</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
                            @else
                                <div class="w-full h-48 bg-gray-200 mb-4 rounded flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h4>
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-lg font-bold text-green-600 mb-2">${{ number_format($product->price, 2) }}</p>
                            <p class="text-sm text-gray-500">Category: {{ $product->category->name ?? 'N/A' }}</p>
                            <a href="{{ route('products.show', $product) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Categories Section -->
            @if($categories->count() > 0)
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Shop by Category</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categories as $category)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $category->name }}</h4>
                            <p class="text-gray-600 text-sm mb-4">{{ $category->description ?? 'Browse our collection' }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ $category->products_count }} products</p>
                            <a href="{{ route('categories.show', $category) }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Browse Category
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Empty State -->
            @if($featuredProducts->count() == 0 && $categories->count() == 0)
            <div class="text-center py-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Welcome to ShopHub!</h3>
                <p class="text-gray-600">We're setting up our store. Check back soon for amazing products!</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
