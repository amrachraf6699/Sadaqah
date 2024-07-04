@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-black text-center text-gray-800">Login to Sadaqah</h2>
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="text" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Password">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-yellow-500 hover:text-yellow-700">Forgot your password?</a>
                </div>
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Login
                </button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="font-medium text-yellow-500 hover:text-yellow-700">Sign up</a></p>
        </div>
    </div>
</div>
@endsection
