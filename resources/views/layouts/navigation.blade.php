<div>
    @auth
        <div class="flex space-y-5 w-3/4 text-center text-white font-bold mr-auto ml-auto mt-5">
            <span class="text-black font-bold">Welcome back, {{ auth()->user()->name  }}</span>
            <div class="p-5 bg-purple-700 rounded-lg min-h-52 text-left border-2 border-black">
                <h2 class="text-lg mb-5">Your Spaces</h2>
                <ul class="space-y-2.5">
                    @if (count(auth()->user()->spaces) > 0)
                        @each('spaces.card', auth()->user()->spaces, 'space')
                    @else
                        <li>
                            <span>You are currently not associated with any space.</span>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/spaces/create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="inline-block mr-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1
                                    0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            <span class="text-md">Create New Space</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/spaces') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="inline-block mr-2" viewBox="0 0 16 16">
                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                            </svg>
                            <span class="text-md">Explore Public Spaces</span>
                        </a>
                    </li>
                </ul>
            </div>

            @if(isset($space))
                <div class="p-5 bg-purple-700 rounded-lg min-h-52 text-left border-2 border-black">
                    <h2 class="text-lg mb-5">Space Options</h2>
                    <ul>
                        <li>
                            <a href="{{ route('spaces.edit', ['space' => $space->id]) }}">Update Space</a>
                        </li>
                        <li>
                            <form method="post" action="{{ route('spaces.destroy', ['space' => $space->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete Space</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif

            <a href="{{ url('/logout') }}" class="p-3 bg-purple-700 hover:bg-purple-600 duration-200 border-2
                border-black rounded-md">
                Log out
            </a>
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
