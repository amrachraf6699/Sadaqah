@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-4 text-center">Edit Profile</h2>
            <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Profile Picture -->
                    <div class="flex flex-col items-center">
                        <img src="{{ auth()->user()->profile_picture ? asset(auth()->user()->profile_picture) : asset('default.jpg') }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover mb-4">
                        <input type="file" name="profile_picture" class="mb-4">
                    </div>

                    <!-- User Details -->
                    <div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                            <input type="password" id="password" name="password" class="w-full border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">Update Profile</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
