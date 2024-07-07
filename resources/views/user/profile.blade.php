@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative text-center p-6">
                <div class="inline-block relative">
                    <img src="{{ $user->profile_picture ? asset( $user->profile_picture) : asset('default.jpg') }}" alt="Profile Picture" class="rounded-full border-4 border-white w-32 h-32 object-cover">
                    <a href="{{ route('user.edit') }}" class="absolute top-0 right-0 bg-blue-500 text-white rounded-full p-2">
                        <i class='bx bx-pencil'></i>
                    </a>
                </div>
                <h1 class="text-2xl font-semibold mt-4">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-gray-600">Joined: {{ $user->created_at->format('F d, Y') }}</p>
            </div>
        </div>

        <!-- User's campaigns section -->
        <div class="mt-8" id="campaigns">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800 underline decoration-indigo-600">
                    Your Campaigns
                </h2>
                @can('create', App\Models\Campaign::class)
                    <a href="{{ route('user.campaign.create') }}">
                        <button class="border border-transparent rounded-full font-semibold tracking-wide text-lg md:text-sm px-5 py-3 md:py-2 focus:outline-none focus:shadow-outline bg-indigo-600 text-gray-100 hover:bg-indigo-800 hover:text-gray-200 transition-all duration-300 ease-in-out w-full sm:w-auto">
                            Create Campaign
                        </button>
                    </a>
                @else
                    <p class="text-red-500 text-center">You cannot create more than 4 campaigns.</p>
                @endcan

            </div>
            @if($user->campaigns->isEmpty())
                <p class="text-gray-600">You have not created any campaigns yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->campaigns as $campaign)
                        @php
                            $progress = ($campaign->goal_amount > 0) ? ($campaign->current_amount / $campaign->goal_amount) * 100 : 0;
                            $totalDays = $campaign->created_at->diffInDays($campaign->end_date);
                            $elapsedDays = $campaign->created_at->diffInDays(now());
                            $timeProgress = $totalDays > 0 ? ($elapsedDays / $totalDays) * 100 : 0;
                        @endphp
                        <div class="bg-white shadow-md rounded-lg overflow-hidden relative hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ $campaign->image ? asset($campaign->image) : asset('images/default-campaign.jpg') }}" alt="Campaign Image" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold">
                                    <a href="{{ route('campaigns.show', $campaign->slug) }}" class="text-blue-500 hover:underline">{{ Str::limit($campaign->title, 20) }}</a>
                                </h5>
                                <p class="text-gray-600 mb-4">{{ Str::limit($campaign->description, 25) }}</p>
                                <div class="h-2 bg-gray-200 rounded-full mb-2">
                                    <div class="h-full bg-green-500 rounded-full" style="width: min(100%, {{ $progress }}%)"></div>
                                </div>
                                <p class="text-gray-600 text-xs mb-4">
                                    ${{ number_format($campaign->current_amount, 2) }} raised of ${{ number_format($campaign->goal_amount, 2) }} goal ({{ number_format(min($progress, 100), 2) }}% funded)
                                </p>
                                <div class="h-2 bg-gray-200 rounded-full mb-4">
                                    <div class="h-full bg-red-500 rounded-full" style="width: {{ $timeProgress }}%"></div>
                                </div>
                                <p class="text-gray-600 text-xs mb-4">{{ number_format($timeProgress, 2) }}% of campaign duration elapsed</p>
                            </div>
                            <!-- Edit button -->
                            <div class="p-4 border-t border-gray-200 bg-gray-50 flex justify-center space-x-4">
                                <a href="{{ route('user.campaign.edit',['campaign'=>$campaign->slug]) }}" class="bg-blue-500 text-white rounded-full p-2 shadow-md hover:bg-blue-700 transition-colors duration-300 flex items-center justify-center w-10 h-10">
                                    <i class='bx bx-pencil text-xl'></i>
                                </a>
                                <a href="{{ route('campaigns.show', $campaign->slug) }}" class="bg-gray-500 text-white rounded-full p-2 shadow-md hover:bg-gray-700 transition-colors duration-300 flex items-center justify-center w-10 h-10">
                                    <i class='bx bx-show text-xl'></i>
                                </a>
                                <form method="POST" action="{{ route('user.campaign.delete',['campaign'=>$campaign->slug]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white rounded-full p-2 shadow-md hover:bg-red-700 transition-colors duration-300 flex items-center justify-center w-10 h-10">
                                        <i class='bx bx-trash text-xl'></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- User's donations section -->
        <div class="mt-8">
            <h2 class="text-3xl underline font-semibold mb-6 text-center">Your Donations</h2>
            @if($donations->isEmpty())
                <p class="text-gray-600">You have not made any donations yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($donations as $donation)
                        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between relative">
                            <div>
                                <h5 class="text-lg font-semibold">
                                    <a href="{{ route('campaigns.show', $donation->campaign->slug) }}" class="text-blue-500 hover:underline">{{ Str::limit($donation->campaign->title, 20) }}</a>
                                </h5>
                                <p class="text-gray-600 mt-2 text-2xl text-center">${{ number_format($donation->amount, 2) }}<span class="text-indigo-500 text-xs"> ({{ $donation->created_at->format('F d, Y') }})</span></p>
                                <p class="text-gray-600"></p>
                            </div>
                            <div class="mt-2 border-t border-gray-200 bg-gray-50 flex justify-center space-x-4">
                                <a href="{{ route('user.download.invoice', ['campaign'=>$donation->campaign,'amount'=>number_format($donation->amount, 2)]) }}" class="mt-2 bg-blue-500 text-white rounded-full p-2 shadow-md hover:bg-blue-600 transition-colors duration-300 flex items-center justify-center w-12 h-12">
                                    <i class='bx bx-paperclip text-xl'></i>
                                </a>
                                <a href="{{ route('user.download.thanks', ['campaign'=>$donation->campaign,'amount'=>number_format($donation->amount, 2)]) }}" class="mt-2 bg-green-500 text-white rounded-full p-2 shadow-md hover:bg-green-600 transition-colors duration-300 flex items-center justify-center w-12 h-12">
                                    <i class='bx bx-heart text-xl'></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5">
                {{ $donations->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
