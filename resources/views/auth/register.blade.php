@extends('layouts.auth-layout')
@section('title', 'Register')
@section('content')
    <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
        <div class="grid grid-cols-1 py-3">
            <img class="box-border h-24 w-24 mx-auto" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
        </div>
        <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
            @include('layouts.alert')
            <div class="px-5 py-7">
                <form action="{{ route('auth.post-register') }}" method="POST">
                    @csrf
                    <label for="name" class="font-semibold text-sm text-gray-600 pb-1 block">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
                    <label for="username" class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                    <input id="username" name="username" type="email" value="{{ old('username') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
                    <label for="password" class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                    <input id="password" name="password" type="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
                    <label for="confirm_password" class="font-semibold text-sm text-gray-600 pb-1 block">Confirm Password</label>
                    <input id="confirm_password" name="confirm_password" type="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
                    <button type="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                        <span class="inline-block mr-2">Register</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-2 gap-1">
                    <button type="button" class="transition duration-200 border border-gray-200 text-gray-500 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center inline-block">Google</button>
                    <button type="button" class="transition duration-200 border border-gray-200 text-gray-500 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center inline-block">Facebook</button>
                </div>
            </div>
            <div class="py-5">
                <div class="grid grid-cols-1 py-2">
                    <div class="text-center whitespace-nowrap">
                        <a href="{{ route('auth.login') }}" class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-bottom	">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="inline-block ml-1">Already have an account? Login here</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="grid grid-cols-2 gap-1">
                <div class="text-center sm:text-left whitespace-nowrap">
                    <a href="{{ route('index.home') }}" class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="inline-block ml-1">Back to {{ config('app.name') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
