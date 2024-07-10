@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-black text-center text-gray-800">Reset Password</h2>
        <form class="mt-8 space-y-6" action="" method="POST">
            @csrf
            <div class="rounded-md shadow-sm">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="text" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Email address" value="{{ old('email') }}">
                </div>
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
