@extends('layouts.app.default')
@section('title', $campaign->title)
@section('content')
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <div class="flex flex-col w-full pt-4 pb-10 justify-center items-center text-center md:text-center">
                <h1 class="my-4 text-5xl font-bold leading-tight">
                    {{ $campaign->title }}
                </h1>
            </div>
        </div>
    </div>
    <section class="bg-white py-8 text-black">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
            <div class="grid grid-cols-1 xl:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="order-2 xl:order-1 lg:order-1 p-3">
                    <div class="grid gap-4 grid-flow-row">
                        <div class="flex items-center">
                            <img class="flex-none w-10 h-10 mr-3" src="{{ $campaign->user->profile ? '' : asset('img/anonymous-user.png') }}" alt="User">
                            <h3 class="flex-grow">{{ $campaign->user->name }} is organizing this fundraiser.</h3>
                        </div>
                        <hr>
                        <div class="flex items-center">
                            <h3 class="text-gray-500"><span class="fa fa-clock-o mr-1"></span> Created {{ $campaign->created_at != null ? $campaign->created_at->diffForHumans() : 'unknown' }}</h3>
                            <span class="mx-4 text-gray-500">|</span>
                            <h3 class="text-gray-500"><span class="fa fa-map-marker mr-1"></span> {{ $campaign->location }}</h3>
                        </div>
                        <hr>
                    </div>
                    <div class="w-full">
                        <article class="prose pt-4">
                            @markdown
                            {!! $campaign->description !!}
                            @endmarkdown
                        </article>
                    </div>
                </div>
                <div class="order-1 xl:order-2 lg:order-2 p-3">
                    <div class="grid gap-3 grid-flow-row border-solid border-gray-200 border-1 rounded-md shadow-md p-4">
                        <div class="flex items-end">
                            <p class="flex-none text-2xl font-bold text-black">EGP {{ number_format($campaign->collected, 0, 0, '.') }}</p>
                            <p class="flex-frow ml-1 pb-1 text-black text-gray-500">raised of EGP {{ number_format($campaign->target, 0, 0, '.') }} goal</p>
                        </div>
                        <div class="overflow-hidden h-1.5 text-xs flex rounded bg-blue-200">
                            <div style="width:{{ round(($campaign->collected / $campaign->target) * 100) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-700"></div>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">
                                @if($donors >= 1)
                                    {{ number_format($donors, 0, 0, '.') }} peoples have donated to this fundraiser
                                @else
                                    Be the first to donate
                                @endif
                            </p>
                        </div>
                        <!-- Latest Donations -->
                        <h2 class="text-lg font-bold">Latest Donation</h2>
                        <div class="grid-flow-row mb-4">
                            @forelse($latest as $donor)
                            <div class="flex">
                                <img src="{{ asset('img/anonymous-user.png') }}" alt="" class="w-14 h-14">
                                <div class="grid-flow-row pl-3">
                                    <p class="font-bold">{!! $donor->anonymous ? '<i>Anonymous</i>' : $donor->user->name !!}</p>
                                    <p class="">EGP {{ number_format($donor->amount, 0, 0, '.') }} &middot; {{ $donor->paid_at ? $donor->paid_at->diffForHumans() : 'unknown time' }}</p>
                                </div>
                            </div>
                            <hr class="my-3">
                            @empty
                                <i class="text-sm">Be the first to donate</i>
                            @endforelse
                        </div>
                        <div class="mb-7" style="display: none" id="donate-container">
                            <form action="{{ route('index.post-donate', ['code' => $campaign->code]) }}" method="POST" id="donate-form">
                                @csrf
                                <div class="w-full items-center flex px-2">
                                    <span class="items-center text-md pt-1">EGP</span>
                                    <input type="text" name="amount" id="amount" placeholder="Enter Amount" class="amount rounded-full ml-2 w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autocomplete="off" required>
                                    <div class="flex items-center mx-2">
                                        <input name="send-anonymous" value="1" type="checkbox" id="send-anonymous">
                                        <label class="text-xs ml-1" for="send-anonymous">Send as Anonymous</label>
                                    </div>
                                    <button id="btn-pay" type="submit" class="text-white bg-blue-500 border hover:bg-blue-700 hover:text-white active:bg-blue-700 font-bold px-8 py-3 rounded-full outline-none focus:outline-none ease-linear transition-all duration-100">Pay</button>
                                    <p id="donate-alert-text" class="text-sm ml-2 text-red-600" style="display: none"></p>
                                </div>
                            </form>

                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <button id="btn-donate" class="mb-4 w-full text-white bg-blue-500 border hover:bg-blue-700 hover:text-white active:bg-blue-700 font-bold px-8 py-3 rounded-full outline-none focus:outline-none ease-linear transition-all duration-100" type="button">
                            <i class="fa fa-handshake-o mr-1"></i> Donate now
                        </button>
                        @else
                            <a href="{{ route('auth.login', ['_next' => url()->full()]) }}" class="mb-4 w-full text-center text-white bg-blue-500 border hover:bg-blue-700 hover:text-white active:bg-blue-700 font-bold px-8 py-3 rounded-full outline-none focus:outline-none ease-linear transition-all duration-100">Login to Donate</a>
                        @endif
                        <div class="addthis_inline_share_toolbox_gl2a"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                <g class="wave" fill="#ffffff">
                    <path
                        d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"
                    ></path>
                </g>
                <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                    <g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                        <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                        <path
                            d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                            opacity="0.100000001"
                        ></path>
                        <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
                    </g>
                </g>
            </g>
        </g>
    </svg>
    <section class="container mx-auto text-center py-6 mb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
            Call to Action
        </h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <h3 class="w-full my-4 text-3xl leading-tight">
            Sign up for free and start donate or making a fundraiser
        </h3>
        <div class="w-full pt-10 pb-3">
            <a href="{{ route('auth.register') }}" class="mx-auto lg:mx-0 bg-white text-gray-800 font-bold rounded-full py-3 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                Join Now
            </a>
        </div>
    </section>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://raw.githubusercontent.com/ixkaito/unreset-css/master/_unreset.scss">
    <style>
        .prose {
            max-width: none!important;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b1d15e2447d3451"></script>
    <script defer>
        $(document).ready(function() {
            let amountInput = $('#amount');
            let donateAlertText = $('#donate-alert-text');
            amountInput.mask('000.000.000', {reverse: true});
            $('#btn-donate').on('click', function() {
                $('#donate-container').fadeIn(1000);
                $(this).hide();
            });
            $('#donate-form').on('submit', function() {
                let amount = parseInt(amountInput.val().replaceAll('.', ''));
                if (amount < 1000) {
                    donateAlertText.fadeIn(500);
                    donateAlertText.text('The minimum amount of donation is EGP 1.000')
                    return false;
                }
            });
        });
    </script>
@endsection
