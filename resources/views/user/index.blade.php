<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Repeat Support</title>
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
                        Welcome Back
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Track and manage your support tickets easily.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Actions Section -->
            <div class="grid grid-cols-2 gap-8 mb-16">
                <!-- Create Ticket Card -->
                <a href="{{ route('user.ticket.create') }}" 
                    class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-repeatyellow/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-repeatyellow/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-repeatyellow/10 rounded-lg">
                                <i class="fa-solid fa-plus-circle text-2xl text-repeatyellow"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-white mb-2">Create New Ticket</h3>
                        <p class="text-gray-400">Submit a new support request</p>
                    </div>
                </a>

                <!-- Agent Request Card -->
                @if (!$hasAgentRequest)
                    <form action="{{ route('user.agent-request.submit') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full h-full text-left">
                            <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-purple-500/50 transition-all duration-300 overflow-hidden h-full">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative">
                                    <div class="flex justify-between items-start mb-8">
                                        <div class="p-3 bg-purple-500/10 rounded-lg">
                                            <i class="fa-solid fa-user-shield text-2xl text-purple-500"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-2xl font-display font-bold text-white mb-2">Become an Agent</h3>
                                    <p class="text-gray-400">Apply to join our support team</p>
                                </div>
                            </div>
                        </button>
                    </form>
                @else
                    <div class="relative bg-black/40 rounded-xl p-8 border border-gray-600/50 opacity-75">
                        <div class="relative">
                            <div class="flex justify-between items-start mb-8">
                                <div class="p-3 bg-gray-500/10 rounded-lg">
                                    <i class="fa-solid fa-user-clock text-2xl text-gray-500"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-display font-bold text-gray-400 mb-2">Request Pending</h3>
                            <p class="text-gray-500">Your agent application is being reviewed</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Recent Tickets Section -->
            <section class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50 flex items-center justify-between">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Recent Tickets</h2>
                    <a href="{{ route('user.tickets') }}" 
                        class="inline-flex items-center px-4 py-2 bg-repeatyellow/10 text-repeatyellow rounded-lg hover:bg-repeatyellow/20 transition-all duration-200 group">
                        View All
                        <i class="fa-solid fa-arrow-right ml-2 text-sm transition-transform duration-200 group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($recentTickets as $ticket)
                        <div class="px-8 py-5 flex items-center justify-between hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700">
                                    <i class="fa-solid fa-ticket-alt text-lg text-gray-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium mb-1">{{ $ticket->title }}</h3>
                                    <p class="text-sm text-gray-400">{{ $ticket->category->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium ring-1 
                                    {{ $ticket->status === 'pending' ? 'bg-yellow-500/20 text-yellow-500 ring-yellow-500/30' : '' }}
                                    {{ $ticket->status === 'open' ? 'bg-blue-500/20 text-blue-500 ring-blue-500/30' : '' }}
                                    {{ $ticket->status === 'closed' ? 'bg-gray-500/20 text-gray-400 ring-gray-500/30' : '' }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                                <a href="{{ route('user.ticket', $ticket) }}" 
                                    class="text-repeatyellow hover:text-yellow-300 transition-colors duration-200">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-ticket-alt text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Tickets Yet</h3>
                            <p class="text-gray-500">Create your first support ticket to get started</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>

</html>
