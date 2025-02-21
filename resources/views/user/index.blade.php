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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-user.sidebar />

        <!-- Main Content -->
        <main class="w-4/5 p-8">
            <!-- Top Buttons Section -->
            <div class="mb-12 flex space-x-4"> <!-- Flex container for buttons -->
                <a href="{{ route('user.ticket.create') }}"
                    class="flex-grow py-3 px-6 border border-repeatyellow rounded-md text-base font-medium text-repeatyellow hover:bg-repeatyellow hover:text-repeatblack focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-repeatyellow transition-colors duration-200">
                    <i class="fa-solid fa-plus-circle mr-2"></i> Create New Ticket
                </a>

                @if (!$hasAgentRequest)
                    <form action="{{ route('user.agent-request.submit') }}" method="POST" class="flex-grow">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 px-6 border border-gray-700 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                            <i class="fa-solid fa-user-shield mr-2"></i> Request to be Agent
                        </button>
                    </form>
                @else
                    <button disabled
                        class="w-full py-3 px-6 border border-gray-500 rounded-md text-base font-medium text-gray-500 cursor-not-allowed">
                        <i class="fa-solid fa-user-shield mr-2"></i> Agent Request Pending
                    </button>
                @endif
            </div>

            <div class="space-y-10">

                <!-- Recent Tickets Section (moved below form) -->
                <section class="bg-repeatgray p-8 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-display text-2xl font-bold text-repeatyellow">Your Recent Tickets</h3>
                        <a href="{{ route('user.tickets') }}" class="text-sm text-repeatyellow hover:underline">View All
                            Tickets</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-repeatgray">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Ticket ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Subject</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Last Update</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">View</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-repeatblack divide-y divide-gray-700">
                                @forelse($recentTickets as $ticket)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            #{{ $ticket->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $ticket->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $ticket->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($ticket->status === 'pending') bg-yellow-700 text-yellow-300
                                                @elseif($ticket->status === 'open') bg-blue-700 text-blue-300
                                                @elseif($ticket->status === 'closed') bg-gray-500 text-gray-300 @endif">
                                                {{ ucfirst($ticket->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $ticket->updated_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('user.ticket', $ticket) }}"
                                                class="text-repeatyellow hover:text-yellow-300">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                            No tickets found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>

</html>
