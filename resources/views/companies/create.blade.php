@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-20">
        <div class="p-4 bg-white shadow-md rounded-lg">
            <div class="flex justify-between mb-10">
                <div class="card-header font-bold text-xl text-gray-800">Create Company</div>
                @if (Auth::check())
                    <a href="{{ route('companies.index') }}"
                        class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Check All Companies</a>
                @endif


            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                        <input id="name" type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="symbol" class="block text-gray-700 font-bold mb-2">Symbol</label>
                        <input id="symbol" type="text" value="{{ old('symbol') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('symbol') border-red-500 @enderror"
                            name="symbol" required autocomplete="symbol">
                        <span class="text-gray-500 text-xs italic">please type a symbol of one of NASDAQ companies ex: ('META',
                            'AA', 'IBM', etc...)</span>

                        @error('symbol')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                        <input id="address" type="text" value="{{ old('address') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror"
                            name="address" required autocomplete="address">

                        @error('address')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea id="description" type="text" resize="none" rows="3" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                            name="description" required autocomplete="description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="logo" class="block text-gray-700 font-bold mb-2">Logo</label>
                        <input id="logo" type="file" value="{{ old('logo') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror"
                            name="logo" required autocomplete="logo">
                        <span class="text-gray-500 text-xs italic">Max size is 2MB.</span>
                        @error('logo')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
