@extends('layouts.app')
@section('title', Str::limit($notification->data['message'],15))
@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-4 text-center">Notification Details</h1>

        <div class="mb-4">
            <p class="text-gray-800 font-medium text-2xl">Message:</p>
            <p class="text-gray-600">{{ $notification->data['message'] }}</p>
        </div>


        <div class="mb-4">
            <p class="text-gray-800 font-medium text-lg">Details:</p>
            <p class="text-gray-600">{{ $notification->data['details'] }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-800 font-medium">Sent At:</p>
            <p class="text-gray-600">{{ $notification->created_at->format('F j, Y, h:i A') }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-800 font-medium">Read at:</p>
            <p class="text-gray-600">{!! $notification->read_at->format('Y-M-d h:i A') . ' <span class="text-xs">( ' . $notification->read_at->diffforhumans() . ')</span>' !!}</p>
        </div>
        <div class="text-center">
            <a href="{{ route('user.notifications') }}" class="text-indigo-500 text-center hover:underline">Back to Notifications</a>
        </div>
    </div>
</div>
@endsection
