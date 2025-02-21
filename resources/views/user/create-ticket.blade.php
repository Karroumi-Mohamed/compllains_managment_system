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

        <!-- Main Content -->
        <main class="w-4/5 p-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-bold text-repeatyellow font-display mb-12">Create New Ticket</h1>

                @if ($errors->any())
                    <div class="bg-red-500 bg-opacity-10 border border-red-400 text-red-400 px-6 py-4 rounded-lg mb-8">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.ticket.store') }}" method="POST"
                    class="space-y-8 rounded-xl p-8 shadow-xl">
                    @csrf
                    <div class="space-y-2">
                        <label for="title" class="block text-base font-medium text-gray-300">Ticket Title</label>
                        <input type="text" name="title" id="title"
                            class="block w-full px-4 py-3 rounded-lg border-2 border-gray-700 text-gray-300 
                            placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200"
                            placeholder="Enter a descriptive title for your ticket" required>
                    </div>

                    <div class="space-y-2">
                        <label for="category_id" class="block text-base font-medium text-gray-300">Category</label>
                        <select name="category_id" id="category_id"
                            class="block w-full px-4 py-3 rounded-lg border-2 border-gray-700 text-gray-300 
                            focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200"
                            required>
                            <option value="" class="bg-gray-800">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-gray-800">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-base font-medium text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="8"
                            class="block w-full px-4 py-3 rounded-lg border-2 border-gray-700 text-gray-300 
                            placeholder-gray-500 focus:border-repeatyellow focus:ring-2 focus:ring-repeatyellow focus:ring-opacity-50 
                            transition-colors duration-200 resize-none"
                            placeholder="Provide detailed information about your issue..." required></textarea>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="{{ route('user') }}"
                            class="px-6 py-3 border-2 border-gray-700 rounded-lg text-gray-300 hover:bg-gray-800 
                            hover:border-gray-600 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-repeatyellow rounded-lg text-repeatblack font-medium hover:bg-yellow-400 
                            transform hover:scale-105 transition-all duration-200">
                            Create Ticket
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
