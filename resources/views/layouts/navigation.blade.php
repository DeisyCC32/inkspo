<nav
    x-data="{ open: false }"
    class="bg-white border-b border-gray-200"
    style="
        position:fixed;
        top:0;
        left:0;
        width:100%;
        z-index:9999;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    "
>

    <div
        style="
            width:100%;
            padding:0 30px;
        "
    >

        <div
            style="
                height:80px;
                display:flex;
                align-items:center;
                justify-content:space-between;
            "
        >

            {{-- LEFT SIDE --}}
            <div
                style="
                    display:flex;
                    align-items:center;
                    gap:40px;
                "
            >

                {{-- LOGO --}}
                <a href="{{ route('home') }}">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Inkspo Logo"
                        style="
                            width:50px;
                            height:50px;
                            object-fit:contain;
                        "
                    >

                </a>


                {{-- MENU --}}
                <div
                    style="
                        display:flex;
                        align-items:center;
                        gap:30px;
                    "
                >

                    @auth

                        {{-- ARTIST --}}
                        @if(auth()->user()->role === 'artist')

                            <a
                                href="{{ route('artist.dashboard') }}"
                                style="
                                    font-weight:600;
                                    color:#374151;
                                    text-decoration:none;
                                "
                            >
                                Artist Dashboard
                            </a>

                        @endif

                        {{-- CUSTOMER --}}
                        @if(auth()->user()->role === 'customer')

                            <a
                                href="{{ url('/my-orders') }}"
                                style="
                                    font-weight:600;
                                    color:#374151;
                                    text-decoration:none;
                                "
                            >
                                My Orders
                            </a>

                        @endif

                    @endauth

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div>

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="
                                inline-flex
                                items-center
                                px-4
                                py-2
                                border
                                rounded-md
                                text-sm
                                font-medium
                                text-gray-600
                                bg-white
                            "
                        >

                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">

                                <svg
                                    class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <a
                            href="{{ route('profile.edit') }}"
                            style="
                                display:block;
                                padding:10px 15px;
                            "
                        >
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                style="
                                    width:100%;
                                    text-align:left;
                                    padding:10px 15px;
                                    color:red;
                                    background:none;
                                    border:none;
                                    cursor:pointer;
                                "
                            >
                                Log Out
                            </button>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>

    </div>

</nav>