<div>
    @auth
        <div class="flex flex-col space-y-5 w-1/2 text-center text-white font-bold mr-auto ml-auto mt-5">
            <span class="text-black font-bold">Welcome back, {{ auth()->user()->name  }}</span>
            <a href="{{ url('/logout') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                Log out
            </a>
        </div>
    @endauth
    @guest
        <div class="flex flex-col space-y-5 w-1/2 text-center text-white font-bold mr-auto ml-auto mt-5">
            <a href="{{ url('/register') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                Register
            </a>
            <a href="{{ url('/login') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                Log In
            </a>
        </div>
    @endguest
</div>
