<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-user.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Create New Ticket
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Submit a new support ticket and we'll help you resolve your issue.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Ticket Creation Form -->
            <div class="max-w-3xl">
                <form action="{{ route('user.ticket.update', $ticket) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-white mb-2">Title</label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="w-full bg-black/40 border border-gray-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-repeatyellow/20 focus:border-repeatyellow/30 transition-all duration-200"
                               placeholder="Brief description of your issue"
                               value="{{ $ticket->title }}"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white mb-2">Category</label>
                        <select name="category_id" 
                                id="category_id" 
                                class="w-full bg-black/40 border border-gray-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-repeatyellow/20 focus:border-repeatyellow/30 transition-all duration-200"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-white mb-2">Description</label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6" 
                                  class="w-full bg-black/40 border border-gray-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-repeatyellow/20 focus:border-repeatyellow/30 transition-all duration-200"
                                  placeholder="Detailed description of your issue"
                                  required>{{ $ticket->description }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('user.tickets') }}" 
                           class="px-6 py-3 rounded-lg inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-3 rounded-lg inline-flex items-center bg-repeatyellow/10 text-repeatyellow border border-repeatyellow/20 hover:bg-repeatyellow/20 transition-all duration-200">
                            <i class="fa-solid fa-paper-plane mr-2"></i>
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @if(session('error'))
        <div id="error-notification" 
            class="fixed bottom-4 right-4 bg-red-500/10 text-red-500 border border-red-500/20 px-6 py-4 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-circle-exclamation text-xl"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('error-notification').style.display = 'none';
            }, 3000);
        </script>
    @endif
</body>
</html>