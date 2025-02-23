<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets - Repeat Support</title>
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
                <div class="max-w-3xl flex items-center justify-between">
                    <div>
                        <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                            My Tickets
                        </h1>
                        <p class="text-xl text-gray-400 leading-relaxed">
                            Track and manage your support requests.
                        </p>
                    </div>
                    <a href="{{ route('user.ticket.create') }}"
                       class="px-6 py-3 rounded-lg inline-flex items-center bg-repeatyellow/10 text-repeatyellow border border-repeatyellow/20 hover:bg-repeatyellow/20 transition-all duration-200">
                        <i class="fa-solid fa-plus mr-2"></i>
                        New Ticket
                    </a>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Tickets List -->
            <div class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Support Tickets</h2>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($tickets as $ticket)
                        <div class="group px-8 py-6 hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <!-- Ticket Info -->
                                <div class="flex-1">
                                    <h3 class="text-white font-medium mb-2">#{{ $ticket->id }} - {{ $ticket->title }}</h3>
                                    <div class="flex items-center gap-4">
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
                                        @endif
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

                                    <!-- View Details Link -->
                                    <a href="{{ route('user.ticket', $ticket) }}"
                                       class="group inline-flex items-center text-repeatyellow hover:text-repeatyellow/80">
                                        View Details
                                        <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-ticket text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Tickets Yet</h3>
                            <p class="text-gray-500">Create your first support ticket to get help</p>
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