@extends('layouts.app')
@section('title','Campaigns')
@section('content')
<div class="px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8 bg-indigo-100" id="blog-posts">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center">
            <h3 class="leading-none font-black text-3xl underline underline-offset-4 mb-4 sm:mb-0 text-center sm:text-left">Our Campaigns</h3>
            @auth
                <a>
                    <button class="border border-transparent rounded-full font-semibold tracking-wide text-lg md:text-sm px-5 py-3 md:py-2 focus:outline-none focus:shadow-outline bg-indigo-600 text-gray-100 hover:bg-indigo-800 hover:text-gray-200 transition-all duration-300 ease-in-out w-full sm:w-auto">
                        Create Campaign
                    </button>
                </a>
            @endauth
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 lg:mt-8">
            @if ($campaigns->isEmpty())
            <div class="text-center col-span-4">
                <div class="text-4xl font-bold text-gray-900">No campaigns found</div>
            </div>
            @else
            @foreach ($campaigns as $campaign)
            <a href="{{ route('campaigns.show',['campaign' => $campaign->slug]) }}" class="transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl rounded-lg bg-gray-100 relative flex flex-col">
                <div class="w-full h-48 bg-cover rounded-t-lg" style='background-image: url("{{ asset($campaign->image) }}");'></div>
                <div class="flex-1 p-6 flex flex-col justify-end">
                    <div class="flex items-center mb-4">
                        <img src="{{ $campaign->user->profile_picture ? url('images/'.$campaign->user->profile_picture) : url('default.jpg') }}" alt="{{ $campaign->user->name }}" class="w-10 h-10 rounded-full mr-4">
                        <div>
                            <div class="text-lg font-bold">{{ $campaign->title }}</div>
                            <div class="mt-3 text-gray-900 text-xs">By: {{ $campaign->user->name }}</div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
        <div class="mt-8 text-center">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>
@endsection
