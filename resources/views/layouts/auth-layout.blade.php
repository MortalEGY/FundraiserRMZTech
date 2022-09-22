<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.icons')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
</head>
<body>
<!-- component -->
<div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
    @yield('content')
</div>
</body>
</html>
