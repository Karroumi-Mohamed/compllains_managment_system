<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-admin.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section with enhanced styling -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Categories
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Manage support ticket categories and organization.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Add Category Section -->
            <div class="mb-12">
                <form action="{{ route('admin.category.create') }}" method="POST" 
                    class="bg-black/40 rounded-xl border border-gray-800/50 p-6 backdrop-blur-sm">
                    @csrf
                    <div class="flex items-center gap-4">
                        <div class="flex-grow">
                            <input type="text" name="name" 
                                class="block w-full px-4 py-3 rounded-lg bg-black/40 border-2 border-gray-700 text-gray-300 
                                placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                                transition-colors duration-200"
                                placeholder="Enter category name"
                                required>
                        </div>
                        <button type="submit" 
                            class="px-6 py-3 rounded-lg inline-flex items-center justify-center bg-repeatyellow 
                            text-repeatblack font-medium hover:bg-[#FCD34D] transition-all duration-200
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-repeatblack focus:ring-repeatyellow">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories List -->
            <div class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Available Categories</h2>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($categories as $category)
                        <div class="px-8 py-5 flex items-center justify-between hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700">
                                    <i class="fa-solid fa-tag text-lg text-gray-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium mb-1">{{ $category->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $category->tickets_count }} tickets</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <!-- Edit Button -->
                                <button onclick="editCategory('{{ $category->id }}', '{{ $category->name }}')" 
                                    class="p-2 text-gray-400 hover:text-repeatyellow transition-colors duration-200">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <!-- Delete Button -->
                                @if($category->tickets_count === 0)
                                    <form action="{{ route('admin.category.delete', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')"
                                            class="p-2 text-gray-400 hover:text-red-500 transition-colors duration-200">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-tag text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Categories Yet</h3>
                            <p class="text-gray-500">Create your first category to get started</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($categories->hasPages())
                    <div class="px-8 py-4 border-t border-gray-800/50">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Edit Category Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center">
        <div class="bg-repeatblack rounded-xl border border-gray-800/50 p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-display font-bold text-repeatyellow mb-6">Edit Category</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="editName" class="block text-sm font-medium text-gray-300 mb-2">Category Name</label>
                        <input type="text" id="editName" name="name" 
                            class="block w-full px-4 py-3 rounded-lg bg-black/40 border-2 border-gray-700 text-gray-300 
                            placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200"
                            required>
                    </div>
                    <div class="flex items-center justify-end space-x-4">
                        <button type="button" onclick="closeEditModal()"
                            class="px-6 py-3 rounded-lg inline-flex items-center justify-center border-2 border-gray-700 
                            text-gray-300 hover:bg-gray-800 hover:border-gray-600 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-3 rounded-lg inline-flex items-center justify-center bg-repeatyellow 
                            text-repeatblack font-medium hover:bg-[#FCD34D] transition-all duration-200
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-repeatblack focus:ring-repeatyellow">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editCategory(id, name) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const nameInput = document.getElementById('editName');

            form.action = `/admin/categories/${id}`;
            nameInput.value = name;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal on outside click
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Show success/error messages
        @if(session('success'))
            // You can implement a toast notification here
            console.log("{{ session('success') }}");
        @endif

        @if(session('error'))
            // You can implement a toast notification here
            console.log("{{ session('error') }}");
        @endif
    </script>
</body>
</html>