<div>
    @auth
        <navbar-menu>
            <template #left-menu>
                <a href="{{ url('/') }}" class="text-black font-bold">{{ env('APP_NAME') }}</a>
            </template>
            <template #right-menu>
                <space-menu :spaces='@json(auth()->user()->spaces)'></space-menu>
                @if(isset($space))
                    <navbar-dropdown-menu :items='[{name: "Edit Space", link: "/spaces/{{ $space->id }}/edit"}, {name: "Delete Space", link: "/spaces/{{ $space->id }}/delete"}, ]'>
                        <template #nav-option>Space Options</template>
                    </navbar-dropdown-menu>
                @endif
                <navbar-dropdown-menu :items='[{name: "Profile", link: "/users/{{ auth()->user()->id }}"}, {name: "Edit Account", link: "/users/{{ auth()->user()->id }}/edit"}, {name: "Log Out", link: "/logout"} ]'>
                    <template #nav-option>{{ auth()->user()->name }}</template>
                </navbar-dropdown-menu>
            </template>
        </navbar-menu>
    @endauth
    @guest
        <navbar-menu>
            <template #rightSide>
                <a href="{{ url('/register') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                    Register
                </a>
                <a href="{{ url('/login') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                    Log In
                </a>
            </template>
        </navbar-menu>
    @endguest
</div>
