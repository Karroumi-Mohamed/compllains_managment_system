<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-user.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section with enhanced styling -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Create New Ticket
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Submit a new support request and we'll help you out.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Form Section -->
            <div class="max-w-3xl">
                @if ($errors->any())
                    <div class="bg-red-500/10 backdrop-blur-sm border border-red-500/20 rounded-xl p-6 mb-8">
                        <div class="flex items-center mb-4">
                            <i class="fa-solid fa-circle-exclamation text-red-500 mr-3"></i>
                            <h3 class="text-lg font-medium text-red-400">Please fix the following errors</h3>
                        </div>
                        <ul class="space-y-1 text-red-400 text-sm ml-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.ticket.store') }}" method="POST"
                    class="bg-black/40 rounded-xl border border-gray-800/50 p-8 space-y-8 backdrop-blur-sm">
                    @csrf

                    <!-- Title Field -->
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-300">Ticket Title</label>
                        <div class="relative">
                            <input type="text" name="title" id="title"
                                class="block w-full px-4 py-3 rounded-lg bg-black/40 border-2 border-gray-700 text-gray-300 
                                placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                                transition-colors duration-200"
                                placeholder="Enter a descriptive title for your ticket"
                                value="{{ old('title') }}"
                                required>
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-medium text-gray-300">Category</label>
                        <select name="category_id" id="category_id"
                            class="block w-full px-4 py-3 rounded-lg bg-black/40 border-2 border-gray-700 text-gray-300 
                            focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200"
                            required>
                            <option value="" class="bg-repeatblack">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-repeatblack"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description Field -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="8"
                            class="block w-full px-4 py-3 rounded-lg bg-black/40 border-2 border-gray-700 text-gray-300 
                            placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200 resize-none"
                            placeholder="Provide detailed information about your issue..."
                            required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('user') }}"
                            class="px-6 py-3 rounded-lg inline-flex items-center justify-center border-2 border-gray-700 
                            text-gray-300 hover:bg-gray-800 hover:border-gray-600 transition-all duration-200 min-w-[120px]">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-lg inline-flex items-center justify-center bg-repeatyellow 
                            text-repeatblack font-medium hover:bg-[#FCD34D] transition-all duration-200 min-w-[120px]
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-repeatblack focus:ring-repeatyellow">
                            <i class="fa-solid fa-paper-plane mr-2"></i>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
