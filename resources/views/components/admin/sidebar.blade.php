<aside class="w-1/5 bg-repeatyellow p-8 shadow-yellow-glow flex flex-col justify-between">
    <div>
        <div class="mb-14">
            <a href="{{ route('admin') }}" class="block font-display text-2xl font-bold text-repeatblack">
                Repeat <span class="font-normal">Admin</span>
            </a>
        </div>
        <nav class="space-y-6">
            <a href="{{ route('admin') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('admin') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-chart-line mr-3 text-lg"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.categories') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('admin.categories') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-tags mr-3 text-lg"></i>
                Categories
            </a>
            <a href="{{ route('admin.tickets') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('admin.tickets') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-ticket-alt mr-3 text-lg"></i>
                Tickets
            </a>
            <a href="{{ route('admin.agent-requests') }}"
                class="flex items-center text-repeatblack hover:text-repeatblack font-medium group {{ request()->routeIs('admin.agent-requests') ? 'bg-black/10 -mx-4 px-4 py-2 rounded-lg' : '' }}">
                <i class="fa-solid fa-user-shield mr-3 text-lg"></i>
                Agent Requests
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
