<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <!-- Background decorative elements -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-repeatyellow/10 rounded-full blur-[128px] rotate-[5deg]"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-repeatyellow/5 rounded-full blur-[128px] -rotate-[5deg]"></div>
    </div>

    <div class="min-h-screen flex">
        <x-agent.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section -->
            <header class="mb-16 relative">
                <div class="max-w-3xl relative z-10">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Agent Dashboard
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed max-w-2xl">
                        Welcome back, {{ auth()->user()->name }}. Here's an overview of your assigned tickets.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute -top-20 right-0 w-96 h-96 bg-repeatyellow/5 rounded-full blur-[128px] -z-10"></div>
            </header>

            <!-- Stats Grid -->
            <section class="grid grid-cols-4 gap-8 mb-16">
                <!-- Total Tickets Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-repeatyellow/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-repeatyellow/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-repeatyellow/10 rounded-lg">
                                <i class="fa-solid fa-ticket text-2xl text-repeatyellow"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Total Tickets</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $totalAssignedTickets }}</h3>
                            <p class="text-gray-400">Assigned to you</p>
                        </div>
                    </div>
                </div>

                <!-- Open Tickets Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-yellow-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-yellow-500/10 rounded-lg">
                                <i class="fa-solid fa-envelope-open text-2xl text-yellow-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Open</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $openTickets }}</h3>
                            <p class="text-gray-400">Currently open</p>
                        </div>
                    </div>
                </div>

                <!-- In Progress Tickets Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-orange-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-orange-500/10 rounded-lg">
                                <i class="fa-solid fa-clock text-2xl text-orange-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">In Progress</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $inProgressTickets }}</h3>
                            <p class="text-gray-400">Being worked on</p>
                        </div>
                    </div>
                </div>

                <!-- Closed Tickets Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-green-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-green-500/10 rounded-lg">
                                <i class="fa-solid fa-check-circle text-2xl text-green-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Closed</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $closedTickets }}</h3>
                            <p class="text-gray-400">Completed tickets</p>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Recent Tickets Section -->
            <section class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50 flex items-center justify-between">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Recent Tickets</h2>
                    <a href="{{ route('agent.tickets') }}" class="group inline-flex items-center text-sm text-repeatyellow hover:text-repeatyellow/80 transition-colors duration-200">
                        View All Tickets 
                        <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                    </a>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($recentTickets as $ticket)
                        <div class="group px-8 py-6 hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center justify-between">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ring-1
                                        {{ $ticket->status === 'open' ? 'bg-yellow-500/20 text-yellow-500 ring-yellow-500/30' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'bg-orange-500/20 text-orange-500 ring-orange-500/30' : '' }}
                                        {{ $ticket->status === 'closed' ? 'bg-green-500/20 text-green-500 ring-green-500/30' : '' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                    <a href="{{ route('agent.ticket', $ticket) }}" 
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
                            <p class="text-gray-500">You haven't been assigned any tickets yet</p>
                        </div>
                    @endforelse
                </div>
            </section>
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
