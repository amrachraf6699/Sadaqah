@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-12 text-indigo-700">Edit Campaign</h1>

    <form action="{{ route('user.campaign.update',['campaign'=>$campaign->slug]) }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')
        @if($campaign->image)
        <div class="mb-4 flex justify-center">
            <img src="{{ asset($campaign->image) }}" alt="Campaign Image" class="w-64 object-cover rounded-lg shadow-md">
        </div>
        @endif

        <!-- Campaign Title -->
        <div class="mb-6">
            <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $campaign->title) }}" class="w-full border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
        </div>

        <!-- Campaign Description -->
        <div class="mb-6">
            <label for="description" class="block text-lg font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="5" class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">{{ old('description', $campaign->description) }}</textarea>
        </div>

        <!-- Campaign Goal Amount -->
        <div class="mb-6">
            <label for="goal_amount" class="block text-lg font-semibold text-gray-700 mb-2">Goal Amount ($)</label>
            <input type="number" id="goal_amount" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount) }}" class="w-full border @error('goal_amount') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
        </div>

        <!-- Campaign End Date -->
        <div class="mb-6">
            <label for="end_date" class="block text-lg font-semibold text-gray-700 mb-2">End Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $campaign->end_date->format('Y-m-d')) }}" class="w-full border @error('end_date') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
        </div>

        <!-- Campaign Image -->
        <div class="mb-6">
            <label for="image" class="block text-lg font-semibold text-gray-700 mb-2">Campaign Image</label>
            <input type="file" id="image" name="image" class="w-full border @error('image') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="bg-indigo-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">Update Campaign</button>
        </div>
        <div class="text-center mt-3">
            <p class="text-xs">Created at {{ $campaign->created_at->format('Y-m-d h:i') }} | Last update {{ $campaign->updated_at->format('Y-m-d h:i') }}</p>
        </div>

    </form>
</div>
@endsection
