@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-20">
        <div class="p-4 bg-white shadow-md rounded-lg">
            <div class="flex justify-between mb-10">
                <div class="card-header font-bold text-xl text-gray-800">Companies</div>
                @if (Auth::check())
                    <a href="{{ route('companies.create') }}"
                        class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add
                        Company</a>
                @endif
            </div>

            @livewire('company.company-table')
            <div id="modal" class="hidden">
                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        @livewire('company.company-details-modal')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
