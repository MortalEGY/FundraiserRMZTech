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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <style>
        .gradient {
            background: linear-gradient(90deg, #2923e8 0%, #33d42c 100%);
        }
    </style>
    @yield('styles')
</head>
<body class="leading-normal tracking-normal {{ (isset($__alt_nav) && $__alt_nav == true) ? '' : 'text-white gradient' }}" style="font-family: 'Source Sans Pro', sans-serif;">

@include('layouts.app.default_navbar')

@yield('content')

@include('layouts.app.default_footer')

<script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alpinejs@3.2.1/dist/cdn.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    let scrollpos = window.scrollY;
    let header = document.getElementById("header");
    let navcontent = document.getElementById("nav-content");
    let navaction = document.getElementById("navAction");
    let brandname = document.getElementById("brandname");
    let toToggle = document.querySelectorAll(".toggleColour");

        @if(isset($__alt_nav) && $__alt_nav == true)
        header.classList.add("bg-white");
        navaction.classList.remove("bg-white");
        navaction.classList.add("gradient");
        navaction.classList.remove("text-gray-800");
        navaction.classList.add("text-white");

        for (let i = 0; i < toToggle.length; i++) {
            toToggle[i].classList.add("text-gray-800");
            toToggle[i].classList.remove("text-white");
        }
        header.classList.add("shadow");
        navcontent.classList.remove("bg-gray-100");
        navcontent.classList.add("bg-white");
        @else
        document.addEventListener("scroll", function () {
            scrollpos = window.scrollY;
            if (scrollpos > 10) {
                header.classList.add("bg-white");
                navaction.classList.remove("bg-white");
                navaction.classList.add("gradient");
                navaction.classList.remove("text-gray-800");
                navaction.classList.add("text-white");

                for (let i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-gray-800");
                    toToggle[i].classList.remove("text-white");
                }
                header.classList.add("shadow");
                navcontent.classList.remove("bg-gray-100");
                navcontent.classList.add("bg-white");
            } else {
                header.classList.remove("bg-white");
                navaction.classList.remove("gradient");
                navaction.classList.add("bg-white");
                navaction.classList.remove("text-white");
                navaction.classList.add("text-gray-800");

                for (let i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-white");
                    toToggle[i].classList.remove("text-gray-800");
                }

                header.classList.remove("shadow");
                navcontent.classList.remove("bg-white");
                navcontent.classList.add("bg-gray-100");
            }
        });
        @endif
</script>
<script>
    let navMenuDiv = document.getElementById("nav-content");
    let navMenu = document.getElementById("nav-toggle");

    document.onclick = check;
    function check(e) {
        let target = (e && e.target) || (event && event.srcElement);

        if (!checkParent(target, navMenuDiv)) {
            if (checkParent(target, navMenu)) {
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else {
                    navMenuDiv.classList.add("hidden");
                }
            } else {
                navMenuDiv.classList.add("hidden");
            }
        }
    }
    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t === elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }
</script>
@yield('scripts')
</body>
</html>
