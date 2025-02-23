<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tickets - Repeat Support</title>
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
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        All Tickets
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Overview of all support tickets in the system.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Tickets List -->
            <div class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-display font-bold text-repeatyellow">Support Tickets</h2>
                    </div>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($tickets as $ticket)
                        <div class="group px-8 py-6 hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <!-- Ticket Info -->
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700 group-hover:ring-repeatyellow/20 transition-all duration-200">
                                        <span class="text-lg font-medium text-gray-300">{{ substr($ticket->user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-white font-medium mb-1">#{{ $ticket->id }} - {{ $ticket->title }}</h3>
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fa-regular fa-user mr-1"></i>
                                                {{ $ticket->user->name }}
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fa-regular fa-folder mr-1"></i>
                                                {{ $ticket->category->name }}
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                {{ $ticket->created_at->diffForHumans() }}
                                            </div>
                                            @if($ticket->agent)
                                                <div class="flex items-center text-xs text-blue-400">
                                                    <i class="fa-solid fa-user-shield mr-1"></i>
                                                    {{ $ticket->agent->name }}
                                                </div>
                                            @else
                                                <form action="{{ route('admin.assign.agent', $ticket) }}" method="POST" class="inline-flex items-center">
                                                    @csrf
                                                    <select name="agent_id" class="mr-2 bg-black/40 border border-gray-700 rounded-lg text-xs text-gray-300 py-1 px-2">
                                                        <option value="">Select Agent</option>
                                                        @foreach(App\Models\User::whereHas('role', fn($q) => $q->where('name', 'agent'))->get() as $agent)
                                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="p-1 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-all duration-200">
                                                        <i class="fa-solid fa-user-plus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Status and Actions -->
                                <div class="flex items-center space-x-4">
                                    <!-- Response Status -->
                                    @if($ticket->response)
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-repeatyellow/20 text-repeatyellow ring-1 ring-repeatyellow/30">
                                            Response Added
                                        </span>
                                    @endif

                                    <!-- Ticket Status -->
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ring-1
                                        {{ $ticket->status === 'open' ? 'bg-yellow-500/20 text-yellow-500 ring-yellow-500/30' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'bg-orange-500/20 text-orange-500 ring-orange-500/30' : '' }}
                                        {{ $ticket->status === 'closed' ? 'bg-green-500/20 text-green-500 ring-green-500/30' : '' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.ticket', $ticket) }}" 
                                           class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all duration-200"
                                           title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @if(!$ticket->isClosed())
                                            <a href="{{ route('admin.ticket.edit', $ticket) }}" 
                                               class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-all duration-200"
                                               title="Edit Ticket">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('admin.ticket.delete', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this ticket?')"
                                                    class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-white/5 transition-all duration-200"
                                                    title="Delete Ticket">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-ticket text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Tickets Found</h3>
                            <p class="text-gray-500">There are no support tickets in the system yet</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($tickets->hasPages())
                    <div class="px-8 py-4 border-t border-gray-800/50">
                        {{ $tickets->links() }}
                    </div>
                @endif
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