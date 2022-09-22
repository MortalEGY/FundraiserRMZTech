@extends('layouts.app.account.default')
@section('title', 'My Campaigns')
@php($active = 'my-campaigns')
@section('content')
    <div class="">
        <h2 class="text-xl">My Campaigns</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <a href="{{ route('account.create-campaign') }}" class="px-3 py-2 text-sm text-gray-100 rounded-full bg-blue-700 hover:bg-blue-600">Create a new campaign</a>
            </div>
        </div>
        <div class="col-span-12 overflow-auto lg:overflow-visible mt-6">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="text-left whitespace-nowrap pl-3">CAMPAIGN NAME</th>
                    <th class="text-left whitespace-nowrap">COLLECTED / TARGET</th>
                    <th class="text-center whitespace-nowrap">TARGET DATE</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($campaigns as $campaign)
                <tr class="shadow-sm rounded-md">
                    <td class="py-4 my-2 pl-3">
                        <a class="text-blue-600" target="_blank" href="{{ route('index.view', ['code' => $campaign->code]) }}">{{ $campaign->title }}</a>
                    </td>
                    <td>EGP {{ number_format($campaign->collected, 0, 0, '.') }} / EGP {{ number_format($campaign->target, 0, 0, '.') }} ({{ round(($campaign->collected / $campaign->target) * 100, 1) }}%)</td>
                    <td class="text-center">{{ $campaign->target_date->format('F d, Y') }}</td>
                    <td class="w-40">
                        @if($campaign->status == 'ACTIVE')
                        <div class="flex items-center justify-center text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2 w-4 h-4 mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            Active
                        </div>
                        @else
                        <div class="flex items-center justify-center text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2 w-4 h-4 mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            Inactive
                        </div>
                        @endif
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('account.my-campaigns.edit', ['id' => $campaign->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1 w-4 h-4 mr-1">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                Edit
                            </a>
                            <button data-id="{{ $campaign->id }}" class="flex btn-delete-campaign items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1 w-4 h-4 mr-1">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script defer>
        $(document).ready(function() {
            $('.btn-delete-campaign').on('click', function() {
                let id = $(this).data('id');
                let delete_url = '{{ route('account.delete-campaign') }}';

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    footer: '<small><i>Campaign with funds can\'t be deleted, you can deactivate it instead</i></small>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: delete_url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id
                            },
                            success: function(res) {
                                Swal.fire(
                                    res.success ? 'Deleted!' : 'Failed!',
                                    res.message,
                                    res.success ? 'success' : 'warning'
                                ).then(function() {
                                    if (res.success) {
                                        window.location.reload();
                                    }
                                })
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'There was an error while processing your request, please try again later',
                                    'danger'
                                )
                            }
                        })

                    }
                })
            });
        });
    </script>
@endsection
