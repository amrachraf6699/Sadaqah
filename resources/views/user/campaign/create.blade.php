@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-3xl font-semibold mb-6 text-center">Create Campaign</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campaign Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Campaign Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea id="description" name="description" class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        <!-- Campaign Goal Amount -->
        <div class="mb-4">
            <label for="goal_amount" class="block text-gray-700 font-semibold mb-2">Goal Amount</label>
            <input type="number" id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}" class="w-full border @error('goal_amount') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Campaign End Date -->
        <div class="mb-4">
            <label for="end_date" class="block text-gray-700 font-semibold mb-2">End Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full border @error('end_date') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Campaign Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Campaign Image</label>
            <input type="file" id="image" name="image" class="w-full border @error('image') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Submit Button -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">Create Campaign</button>
        </div>
    </form>
</div>
@endsection
