@extends('layouts.app')
@section('title', $campaign->title)
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <!-- Campaign Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="relative">
                    <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">{{ $campaign->title }}</h1>
                    <p class="text-gray-700 mb-4">{{ $campaign->description }}</p>
                    <div class="mb-4">
                        <p class="font-semibold">Goal: ${{ number_format($campaign->goal_amount, 2) }}</p>
                        <p class="font-semibold">Collected: ${{ number_format($campaign->current_amount, 2) }}</p>
                        <p class="font-semibold">End Date: {{ $campaign->end_date->format('F j, Y') }}</p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div class="text-xs font-semibold inline-block py-1 px-2 rounded-full text-teal-600 bg-teal-200 mr-3">
                                    ${{ number_format($campaign->current_amount, 2) }}
                                </div>
                                <div class="text-xs font-semibold inline-block py-1 px-2 rounded-full text-teal-600 bg-teal-200">
                                    ${{ number_format($campaign->goal_amount, 2) }}
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div class="w-full bg-gray-200 rounded-full">
                                            <div class="bg-teal-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: {{ ($campaign->current_amount / $campaign->goal_amount) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Form -->
                    @auth
                    @if ($campaign->user_id == auth()->id())

                    <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-sm mx-auto mt-3">
                        <p class="text-center text-gray-600">You can't donate to your own campaign.</p>
                        <a href="#" class="block text-center text-blue-500 mt-2">Manage My campaigns</a>
                    </div>
                    @else
                    <form action="{{ route('campaigns.donate',['campaign'=>$campaign->slug]) }}" method="POST" class="bg-gray-100 p-6 rounded-lg shadow-md max-w-sm mx-auto mt-3">
                        @csrf
                        <h2 class="text-xl font-bold mb-4">Make a Donation</h2>
                        <div class="flex flex-col space-y-4">
                            <input type="number" id="amount" name="amount" min="1" step="0.01" required class="border border-gray-300 rounded-lg px-4 py-2 w-full" placeholder="Donation Amount" value="{{ old('amount') }}">
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                            <select name="payment_method_id" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                                @foreach($payment_methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                            <textarea name="message" rows="4" class="border border-gray-300 rounded-lg px-4 py-2 w-full" placeholder="Wanna leave a message? (optional)"></textarea>
                            <button type="submit" class="bg-blue-500 text-white font-semibold rounded-lg px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Donate
                            </button>
                        </div>
                    </form>
                    @endif
                    @else
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-sm mx-auto mt-3">
                            <p class="text-center text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to donate.</p>
                        </div>
                    @endauth


                <!-- Sharing Icons Card -->
                    <div class="bg-white shadow-md rounded-lg p-4 mt-6">
                        <h2 class="text-xl font-bold mb-4 text-center">Share this Campaign</h2>
                        <div class="flex justify-center mt-6 space-x-6">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="text-blue-600 hover:text-blue-700 transition duration-300 text-3xl">
                                <i class='bx bxl-facebook-circle'></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="text-blue-400 hover:text-blue-500 transition duration-300 text-3xl">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="https://www.instagram.com/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="text-pink-500 hover:text-pink-600 transition duration-300 text-3xl">
                                <i class='bx bxl-instagram'></i>
                            </a>
                        </div>
                    </div>


                    <hr class="my-8 border-gray-300">

                    <!-- Top Contributors Section -->
                    <div class="mt-8">
                        <h2 class="text-xl font-bold mb-4">Top Contributors</h2>
                        @if($topContributors->isEmpty())
                            <p class="text-gray-600">No contributors yet.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($topContributors as $contributor)
                                    <li class="flex items-center space-x-4">
                                        <img src="{{ $contributor->user->profile_picture ? url('images/'.$contributor->user->profile_picture) : url('default.jpg') }}" alt="{{ $contributor->user->name }}" class="w-12 h-12 rounded-full">
                                        <div>
                                            <p class="text-lg font-semibold">{{ $contributor->user->name }}</p>
                                            <p class="text-gray-600">${{ number_format($contributor->amount, 2) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <hr class="my-8 border-gray-300">

                    <!-- Campaign Creator Section -->
                    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                        <h2 class="text-xl font-bold mb-4">Campaign Creator</h2>
                        <div class="flex items-center space-x-4">
                            <img src="{{ $campaign->user->profile_picture ? url('images/'.$campaign->user->profile_picture) : url('default.jpg') }}" alt="{{ $campaign->user->name }}" class="w-16 h-16 rounded-full border-2 border-gray-300">
                            <div>
                                <p class="text-lg font-semibold">{{ $campaign->user->name }}</p>
                                <p class="text-gray-600">{{ $campaign->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
