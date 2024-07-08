@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Notifications</h1>

    @forelse ($notifications as $notification)
        <a href="{{ route('user.notifications.show',['notification'=>$notification->id]) }}" class="block px-4 py-2 mb-2 text-sm {{ $notification->read_at ? 'text-gray-800 bg-white' : 'text-gray-800 bg-gray-200' }} hover:bg-gray-300 transition-colors duration-150">
            <div class="flex justify-between items-center">
                <span>{{ Str::limit($notification->data['message'], 30) }}</span>
                <span class="text-xs text-gray-500">{{ $notification->created_at->format('M-d h:i A') }}</span>
            </div>
        </a>
    @empty
        <p class="text-gray-500">You have no notifications.</p>
    @endforelse
</div>
@endsection
