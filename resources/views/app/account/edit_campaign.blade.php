@extends('layouts.app.account.default')
@section('title', 'Edit Campaign')
@php($active = 'my-campaigns')
@section('content')
    <div class="">
        <h2 class="text-xl">Edit Campaign</h2>

        <div class="col-span-12 overflow-auto lg:overflow-visible mt-6">
            <form action="{{ route('account.my-campaigns.post-edit', ['id' => $campaign->id]) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="title">
                        Title
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="title" value="{{ $campaign->title }}" name="title" type="text" placeholder="" autocomplete="off" required>
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="location">
                        Location
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="location" value="{{ $campaign->location }}" name="location" type="text" placeholder="" autocomplete="off" required>
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="target">
                        Target (EGP)
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="target" value="{{ $campaign->target }}" name="target" type="number" placeholder="EGP" autocomplete="off" required>
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="target_date">
                        Target Date
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="target_date" value="{{ $campaign->target_date->format('Y-m-d') }}" name="target_date" type="date" placeholder="" autocomplete="off" required>
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="description">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="10">{!! $campaign->description !!}</textarea>
                </div>
                <div class="w-full text-center">
                    <button class="px-6 py-2 text-sm text-gray-100 rounded-full bg-blue-700 hover:bg-blue-600">Save Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script defer>
        $(document).ready(function() {
            let simplemde = new SimpleMDE({
                element: document.getElementById("description"),
                spellChecker: false,
                placeholder: "Type here...",
            });
        });
    </script>
@endsection
