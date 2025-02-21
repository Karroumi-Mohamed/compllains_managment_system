<aside class="w-1/5 bg-repeatyellow p-8 shadow-yellow-glow flex flex-col justify-between">
    <div>
        <div class="mb-14">
            <a href="{{ route('user') }}" class="block font-display text-2xl font-bold text-repeatblack">
                Repeat <span class="font-normal">Support</span>
            </a>
        </div>
        <nav class="space-y-6">
            <a href="{{ route('user') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('user') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-house mr-3 text-lg"></i>
                Dashboard
            </a>
            <a href="{{ route('user.tickets') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('user.tickets') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-ticket-alt mr-3 text-lg"></i>
                My Tickets
            </a>
            <a href="{{ route('user.ticket.create') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('user.ticket.create') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-plus-circle mr-3 text-lg"></i>
                Create Ticket
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group">
                <i class="fa-solid fa-sign-out-alt mr-3 text-lg"></i>
                Logout
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="hidden">
            @csrf
        </form>
    </div>
    <div class="text-sm text-repeatblack">
        © 2025 Repeat Inc.
    </div>
</aside>
