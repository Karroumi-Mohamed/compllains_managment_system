<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket - Repeat Support</title>
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
            <!-- Header Section -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-4 mb-6">
                        <a href="{{ route('admin.ticket', $ticket) }}" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Edit Ticket Status
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Update ticket status and add response
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Ticket Edit Form -->
            <div class="max-w-3xl space-y-8">
                <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                    <h2 class="text-xl font-display font-bold text-white mb-4">Ticket Information</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm text-gray-400">Title:</span>
                            <p class="text-white">{{ $ticket->title }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-400">Description:</span>
                            <p class="text-white">{{ $ticket->description }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-400">Category:</span>
                            <p class="text-white">{{ $ticket->category->name }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.ticket.update', $ticket) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Status Field -->
                    <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                        <h2 class="text-xl font-display font-bold text-white mb-4">Update Status</h2>
                        <select name="status" 
                                id="status" 
                                class="w-full bg-black/40 border border-gray-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-repeatyellow/20 focus:border-repeatyellow/30 transition-all duration-200"
                                required>
                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Response Field -->
                    <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                        <h2 class="text-xl font-display font-bold text-white mb-4">Response</h2>
                        @if($ticket->response)
                            <div class="mb-6">
                                <p class="text-sm text-gray-400 mb-2">Current Response:</p>
                                <div class="bg-white/5 rounded-lg p-4 text-gray-300">
                                    {{ $ticket->response->message }}
                                </div>
                            </div>
                        @endif
                        <textarea name="response" 
                                  id="response" 
                                  rows="6" 
                                  class="w-full bg-black/40 border border-gray-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-repeatyellow/20 focus:border-repeatyellow/30 transition-all duration-200"
                                  placeholder="{{ $ticket->response ? 'Update your response...' : 'Add a response...' }}">{{ old('response') }}</textarea>
                        @error('response')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.ticket', $ticket) }}" 
                           class="px-6 py-3 rounded-lg inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-3 rounded-lg inline-flex items-center bg-repeatyellow/10 text-repeatyellow border border-repeatyellow/20 hover:bg-repeatyellow/20 transition-all duration-200">
                            <i class="fa-solid fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @if(session('success'))
        <div id="notification" 
            class="fixed bottom-4 right-4 bg-green-500/10 text-green-500 border border-green-500/20 px-6 py-4 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-check-circle text-xl"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('notification').style.display = 'none';
            }, 3000);
        </script>
    @endif
</body>
</html>