<div>
    @auth
        <div class="flex justify-between w-full text-center text-white font-bold p-5">
            <div class="space-x-5">
                <a href="{{ url('/') }}" class="text-black font-bold">{{ env('APP_NAME') }}</a>
            </div>
            <div class="flex space-x-5">
                <space-menu :spaces='@json(auth()->user()->spaces)'></space-menu>
                <navbar-dropdown-menu :items='[{name: "Edit Space", link: "/spaces/{{ space.id }}"}, {name: "Delete Space", link: "/spaces/{{ space.id }}/delete"}, ]'>
                    <slot #nav-option>Space Options</slot>
                </navbar-dropdown-menu>
                <span class="text-black font-bold">Space Options</span>
                <span class="text-black font-bold">{{ auth()->user()->name  }}</span>
            </div>
        </div>
    @endauth
    @guest
        <div class="float-right space-x-5 w-1/2 text-center text-white font-bold mr-auto ml-auto mt-5">
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
