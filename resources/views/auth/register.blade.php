@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="min-h-screen flex items-center justify-center px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-black text-center text-gray-800">Register for Sadaqah</h2>
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Name" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Password">
                </div>
                <div>
                    <label for="password-confirmation" class="sr-only">Confirm Password</label>
                    <input id="password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" placeholder="Confirm Password">
                </div>
                <div>
                    <label for="profile-picture" class="sr-only">Profile Picture</label>
                    <input id="profile-picture" name="profile_picture" type="file" class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('profile_picture') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                </div>
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Register
                </button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="font-medium text-yellow-500 hover:text-yellow-700">Login</a></p>
        </div>
    </div>
</div>
@endsection
