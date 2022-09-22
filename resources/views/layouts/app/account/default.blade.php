<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('metas')
    @include('layouts.icons')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}: #1 Fundraising Platform on Mars</title>
    @endif
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    @yield('styles')
</head>
<body style="font-family: 'Source Sans Pro', sans-serif;">
<div class="w-full h-full">
    <div class="flex flex-no-wrap">
        <!-- Sidebar starts -->
        <div style="min-height: 700px" class="w-64 absolute lg:relative bg-white shadow h-screen flex-col justify-between hidden lg:flex pb-12">
            <div class="px-8">
                <div class="h-16 w-full flex items-center">
                    <a class="flex" href="{{ route('index.home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30px" height="30px">
                        <div class="text-xl ml-2">{{ strtoupper(config('app.name')) }}</div>
                    </a>
                </div>
                <ul class="mt-12">
                    @include('layouts.app.account.default_navbar')
                </ul>
            </div>
        </div>
        <div class="absolute w-full h-full transform -translate-x-full z-40 lg:hidden" id="mobile-nav">
            <div class="bg-gray-800 opacity-50 w-full h-full absolute" onclick="sidebarHandler(false)"></div>
            <div class="w-64 md:w-96 absolute z-40 bg-white shadow h-full flex-col justify-between lg:hidden pb-4 transition duration-150 ease-in-out">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <div class="flex items-center justify-between px-8">
                            <div class="h-16 w-full flex items-center">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30px" height="30px">
                                <div class="text-xl ml-2">{{ strtoupper(config('app.name')) }}</div>
                            </div>
                            <div id="closeSideBar" class="flex items-center justify-center h-10 w-10 " onclick="sidebarHandler(false)">
                                <button aria-label="close sidebar"  class="focus:outline-none focus:ring-2 rounded focus:ring-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="px-8">
                            <ul class="mt-12">
                                @include('layouts.app.account.default_navbar', ['mobile' => true])
                            </ul>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="border-t border-gray-300">
                            <div class="w-full flex items-center justify-between px-6 pt-1">
                                <div class="flex items-center">
                                    <img alt="display avatar" role="img" src="//www.royryando.me/logo.png" class="w-8 h-8 rounded-md" />
                                    <p class="md:text-xl text-gray-800 text-base leading-4 ml-2">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Mobile responsive sidebar-->
        <!-- Sidebar ends -->
        <div class="w-full">
            <!-- Navigation starts -->
            <nav class="h-16 flex items-center lg:items-stretch justify-end lg:justify-between bg-white shadow relative z-0">
                <div class="hidden lg:flex w-full pr-6">
                    <div class="w-1/2 h-full hidden lg:flex items-center pl-6 pr-24">
                    </div>
                    <div class="w-1/2 hidden lg:flex">
                        <div class="w-full flex items-center pl-8 justify-end">
                            <div class="flex items-center relative cursor-pointer" onclick="dropdownHandler(this)">
                                <div class="rounded-full">
                                    <ul class="p-2 w-full border-r bg-white absolute rounded left-0 shadow mt-12 sm:mt-16 hidden">
                                        <li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <circle cx="12" cy="7" r="4" />
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                </svg>
                                                <a href="#" class="text-sm ml-2">My Profile</a>
                                            </div>
                                        </li>
                                        <li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mt-2">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                                </svg>
                                                <a href="{{ route('auth.logout') }}" class="text-sm ml-2">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="relative">
                                        <img class="rounded-full h-10 w-10 object-cover" src="//www.royryando.me/logo.png" alt="display avatar" role="img" />
                                        <div class="w-2 h-2 rounded-full bg-green-400 border border-white absolute inset-0 mb-0 mr-0 m-auto"></div>
                                    </div>
                                </div>
                                <p class="text-gray-800 text-sm mx-3">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</p>
                                <button aria-label="toggle profile options" class="cursor-pointer text-gray-600 focus:outline-none focus:ring-2 rounded focus:ring-gray-600" onclick="dropdownHandler(this)">
                                    <svg  aria-haspopup="true" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button aria-label="open sidebar Menu" class="text-gray-600 mr-8 visible lg:hidden relative focus:outline-none focus:ring-2 rounded focus:ring-gray-600" onclick="sidebarHandler(true)" id="menu">
                    <svg  aria-haspopup="true" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu cursor-pointer" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="4" y1="8" x2="20" y2="8" />
                        <line x1="4" y1="16" x2="20" y2="16" />
                    </svg>
                </button>
            </nav>
            <div class="container mx-auto py-10 h-full md:w-4/5 w-11/12 px-6">
                <div class="w-full h-full rounded">
                    @if(session()->has('msg'))
                        @switch(session()->get('msg_type'))
                            @case('error')
                            <div class="bg-red-100 mb-6 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{!! session()->get('msg') !!}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"><svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></span>
                            </div>
                            @break
                            @case('warning')
                            <div class="bg-yellow-100 mb-6 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{!! session()->get('msg') !!}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"><svg class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></span>
                            </div>
                            @break
                            @case('success')
                            <div class="bg-green-100 mb-6 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{!! session()->get('msg') !!}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"><svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></span>
                            </div>
                            @break
                        @endswitch
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>



<script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alpinejs@3.2.1/dist/cdn.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    let sideBar = document.getElementById("mobile-nav");
    let menu = document.getElementById("menu");
    let cross = document.getElementById("cross");
    const sidebarHandler = (check) => {
        if (check) {
            sideBar.style.transform = "translateX(0px)";
            menu.classList.add("hidden");
            cross.classList.remove("hidden");
        } else {
            sideBar.style.transform = "translateX(-100%)";
            menu.classList.remove("hidden");
            cross.classList.add("hidden");
        }
    };
    function dropdownHandler(element) {
        let single = element.getElementsByTagName("ul")[0];
        single.classList.toggle("hidden");
    }
</script>
@yield('scripts')
</body>
</html>
