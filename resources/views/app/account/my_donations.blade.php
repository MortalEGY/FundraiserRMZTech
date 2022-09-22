@extends('layouts.app.account.default')
@section('title', 'My Donations')
@php($active = 'my-donations')
@section('content')
    @if(sizeof($donations) < 1)
        <div class="container w-full text-center">
            <h1 class="text-3xl pb-4">Whoops it's empty 🧐</h1>
            <i class="text-gray-500">Let's start helping those in need, <a class="text-blue-500" href="{{ route('index.browse') }}">browse campaign now</a>.</i>
        </div>
    @else
    <div class="mx-auto w-full h-full">
        <p class="text-right text-xs text-gray-500">*Only the donations you made this year are shown</p>
        <div class="relative wrap overflow-hidden p-10 h-full">
            <div class="border-2-2 absolute border-opacity-20 border-gray-700 h-full border" style="left: 50%"></div>
            @php($isRight = true)
            @php($lastDate = null)
            @foreach($donations as $key => $donation)
                @if($isRight)
                    @if($lastDate == substr($donation->paid_at, 0, 10))
                        <div class="mb-8 flex justify-between items-center w-full right-timeline">
                            <div class="order-1 w-5/12"></div>
                            <div class="order-1 bg-gray-400 rounded-lg shadow-xl w-5/12 px-6 py-4">
                                <h3 class="mb-3 font-bold text-gray-800 text-xl">{{ $donation->campaign->title }}</h3>
                                <p class="text-sm leading-snug tracking-wide text-gray-900 text-opacity-100">
                                    You donate EGP {{ number_format($donation->amount, 0, 0, '.') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="mb-8 flex justify-between items-center w-full right-timeline">
                            <div class="order-1 w-5/12"></div>
                            <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl px-2 w-auto h-8 rounded-full">
                                <h1 class="mx-auto font-semibold text-lg text-white">{{ $donation->paid_at->format('d F Y') }}</h1>
                            </div>
                            <div class="order-1 bg-gray-400 rounded-lg shadow-xl w-5/12 px-6 py-4">
                                <h3 class="mb-3 font-bold text-gray-800 text-xl">{{ $donation->campaign->title }}</h3>
                                <p class="text-sm leading-snug tracking-wide text-gray-900 text-opacity-100">
                                    You donate EGP {{ number_format($donation->amount, 0, 0, '.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                    @if(!isset($donations[$key+1]) || substr($donations[$key+1]->paid_at, 0, 10) != substr($donation->paid_at, 0, 10))
                        @php($isRight = false)
                    @endif
                    @php($lastDate = substr($donation->paid_at, 0, 10))
                @else
                    @if(!$isRight)
                        @if($lastDate == substr($donation->paid_at, 0, 10))
                            <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                                <div class="order-1 w-5/12"></div>
                                <div class="order-1 bg-red-400 rounded-lg shadow-xl w-5/12 px-6 py-4">
                                    <h3 class="mb-3 font-bold text-white text-xl">{{ $donation->campaign->title }}</h3>
                                    <p class="text-sm font-medium leading-snug tracking-wide text-white text-opacity-100">
                                        You donate EGP {{ number_format($donation->amount, 0, 0, '.') }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                                <div class="order-1 w-5/12"></div>
                                <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl px-2 w-auto h-8 rounded-full">
                                    <h1 class="mx-auto text-white font-semibold text-lg">{{ $donation->paid_at->format('d F Y') }}</h1>
                                </div>
                                <div class="order-1 bg-red-400 rounded-lg shadow-xl w-5/12 px-6 py-4">
                                    <h3 class="mb-3 font-bold text-white text-xl">{{ $donation->campaign->title }}</h3>
                                    <p class="text-sm font-medium leading-snug tracking-wide text-white text-opacity-100">
                                        You donate EGP {{ number_format($donation->amount, 0, 0, '.') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endif
                    @if(!isset($donations[$key+1]) || substr($donations[$key+1]->paid_at, 0, 10) != substr($donation->paid_at, 0, 10))
                        @php($isRight = true)
                    @endif
                    @php($lastDate = substr($donation->paid_at, 0, 10))
                @endif
            @endforeach
        </div>
    </div>
    @endif
@endsection
