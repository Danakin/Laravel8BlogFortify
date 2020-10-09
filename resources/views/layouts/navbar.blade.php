<nav class="fixed top-0 left-0 right-0 h-12 bg-blue-400 flex items-center">
    <div class="flex-1"></div>
    {{-- @auth --}}
    @if (Auth::check())
    <form action="{{ route('logout') }}" method="post">@csrf <button type="submit"
            class="h-12 px-4 hover:bg-blue-500">Logout</button></form>
    @endif
    {{-- @endauth --}}
</nav>
