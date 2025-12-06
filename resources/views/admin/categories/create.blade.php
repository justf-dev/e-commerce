<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:text-indigo-800">
                ← Back to Categories
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Add New Category</h1>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Category Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full border rounded-lg px-4 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="w-4 h-4 text-indigo-600 rounded">
                        <label for="is_active" class="ml-2 text-sm font-medium">
                            Active
                        </label>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                            Create Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>