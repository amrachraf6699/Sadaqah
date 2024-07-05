@extends('layouts.app')
@section('title', $user->name. ' Profile')

@section('content')
<div class="container mx-auto px-4">
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg p-4 mt-4 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
        <img src="{{ $user->profile_picture ? url('images/'.$user->profile_picture) : url('default.jpg') }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full">
        <div class="text-center md:text-left pt-4">
            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
            <p class="text-gray-600"><i class='bx bx-envelope'></i> {{ $user->email }}</p>
        </div>
    </div>

    <!-- Donations Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mt-4">
        <h3 class="text-2xl font-semibold mb-6 text-center text-gray-800">Recent Donations</h3>
        <ul class="space-y-6">
            @if ($user->donations->isEmpty())
                <p class="text-gray-600 text-center">No donations yet.</p>
            @else
                @foreach($user->donations as $donation)
                <a href="{{ route('campaigns.show', $donation->campaign) }}" class="block">
                    <li class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                        <i class='bx bx-donate-heart text-2xl text-red-600'></i>
                        <div class="flex-1">
                            <p class="text-lg font-semibold text-gray-800">{{ $donation->campaign->title }}</p>
                            <p class="text-gray-600 mt-1">${{ number_format($donation->amount, 2) }} donated on {{ $donation->created_at->format('M d, Y') }}</p>
                        </div>
                        <i class='bx bx-chevron-right text-xl text-black'></i>

                    </li>
                </a>
                @endforeach
            @endif
        </ul>
    </div>

    <!-- Campaigns Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mt-4">
        <h3 class="text-2xl font-semibold mb-4 text-center">Campaigns</h3>
        <div class="space-y-4">
            @if ($user->campaigns->isEmpty())
                <p class="text-gray-600 text-center">No campaigns yet.</p>
            @else
                @foreach($user->campaigns as $campaign)
                <a href="{{ route('campaigns.show', $campaign) }}" class="block bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-200 transition">
                    <div class="flex items-center space-x-4 p-4">
                        <!-- Campaign Cover Image -->
                        <img src="{{ $campaign->image ? url($campaign->image) : url('default.jpg') }}" alt="{{ $campaign->title }}" class="w-16 h-16 object-cover rounded-md">

                        <div class="flex-1">
                            <p class="text-lg font-semibold">{{ $campaign->title }}</p>
                            <p class="text-gray-600 mt-1">{{ Str::limit($campaign->description, 100) }}</p>
                        </div>

                        <!-- Icon -->
                        <i class='bx bx-chevron-right text-xl text-blue-500'></i>
                    </div>
                </a>
                @endforeach
            @endif
        </div>
    </div>

</div>

@endsection
