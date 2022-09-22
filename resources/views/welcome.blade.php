<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<body>
<p>
    Logged in as: {{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()['name'] : '-' }}
</p>
<hr>
<a href="{{ route('auth.login') }}">Login</a>
<br>
<a href="{{ route('auth.register') }}">Register</a>
<br>
<a href="{{ route('auth.logout') }}">Logout</a>
</body>
</html>
