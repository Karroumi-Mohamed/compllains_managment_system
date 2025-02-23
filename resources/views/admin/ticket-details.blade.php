<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details - Repeat Support</title>
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
                        <a href="{{ route('admin.tickets') }}" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <div class="px-3 py-1 rounded-full text-xs font-medium ring-1
                            {{ $ticket->status === 'open' ? 'bg-yellow-500/20 text-yellow-500 ring-yellow-500/30' : '' }}
                            {{ $ticket->status === 'in_progress' ? 'bg-orange-500/20 text-orange-500 ring-orange-500/30' : '' }}
                            {{ $ticket->status === 'closed' ? 'bg-green-500/20 text-green-500 ring-green-500/30' : '' }}">
                            {{ ucfirst($ticket->status) }}
                        </div>
                    </div>

                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        #{{ $ticket->id }} - {{ $ticket->title }}
                    </h1>
                    <div class="flex items-center gap-6 text-gray-400">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user"></i>
                            Submitted by {{ $ticket->user->name }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-folder"></i>
                            {{ $ticket->category->name }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i>
                            {{ $ticket->created_at->format('M d, Y') }}
                        </div>
                        @if($ticket->agent)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-shield"></i>
                                Assigned to {{ $ticket->agent->name }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Content -->
            <div class="max-w-3xl space-y-8">
                <!-- Description -->
                <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                    <h2 class="text-xl font-display font-bold text-white mb-4">Description</h2>
                    <div class="prose prose-invert max-w-none">
                        {{ $ticket->description }}
                    </div>
                </div>

                <!-- Agent Assignment -->
                @if(!$ticket->agent)
                    <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                        <h2 class="text-xl font-display font-bold text-white mb-4">Assign Agent</h2>
                        <form action="{{ route('admin.assign.agent', $ticket) }}" method="POST">
                            @csrf
                            <div class="flex gap-4">
                                <select name="agent_id" 
                                        class="flex-1 bg-black/40 border border-gray-700 rounded-lg text-gray-300 px-4 py-3">
                                    <option value="">Select an Agent</option>
                                    @foreach(App\Models\User::whereHas('role', fn($q) => $q->where('name', 'agent'))->get() as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        class="px-6 py-3 rounded-lg inline-flex items-center bg-repeatyellow/10 text-repeatyellow border border-repeatyellow/20 hover:bg-repeatyellow/20 transition-all duration-200">
                                    <i class="fa-solid fa-user-plus mr-2"></i>
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Agent Response -->
                @if($ticket->response)
                    <div class="bg-black/40 rounded-xl border border-gray-800/50 p-8">
                        <h2 class="text-xl font-display font-bold text-white mb-4">Agent Response</h2>
                        <div class="bg-white/5 rounded-lg p-6">
                            <p class="text-gray-300">{{ $ticket->response->message }}</p>
                            <div class="mt-4 text-sm text-gray-500">
                                Response from {{ $ticket->response->agent->name }} • {{ $ticket->response->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.ticket.edit', $ticket) }}" 
                       class="px-6 py-3 rounded-lg inline-flex items-center bg-repeatyellow/10 text-repeatyellow border border-repeatyellow/20 hover:bg-repeatyellow/20 transition-all duration-200">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                        Edit Ticket
                    </a>
                    <form action="{{ route('admin.ticket.delete', $ticket) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 rounded-lg inline-flex items-center bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500/20 transition-all duration-200">
                            <i class="fa-solid fa-trash mr-2"></i>
                            Delete Ticket
                        </button>
                    </form>
                </div>
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