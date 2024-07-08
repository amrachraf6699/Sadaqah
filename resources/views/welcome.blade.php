@extends('layouts.app')
@section('title','Home Page')
@section('content')
      <main>
        <div id="hero" class="pt-5 lg:flex items-center">
            <div class="px-5 sm:px-10 md:px-10 md:flex lg:block lg:w-1/2 lg:max-w-3xl lg:mr-8 lg:px-20">
                <div class="md:w-1/2 md:mr-10 lg:w-full lg:mr-0">
                    <h1 class="text-3xl xl:text-4xl font-black md:leading-none xl:leading-tight">
                        Make a Difference Through Sadaqah
                    </h1>
                    <p class="mt-4 xl:mt-2">
                        Embrace the blessings of giving. Support worthy causes, contribute to charitable projects, or start your own initiative. Your generosity brings light and positive change to those in need, and earns you reward in this life and the Hereafter, Insha'Allah.
                    </p>
                </div>
            </div>
          <div class="mt-6 w-full flex-1 lg:mt-0">
            <div></div>
            <img class="border rounded-full" src="{{ asset('cover.jpg') }}" />
          </div>
        </div>
        <div class="px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8 bg-indigo-100 mt-6" id="features">
            <div class="max-w-screen-xl mx-auto">
              <h3 class="leading-none font-black text-3xl">
                Key Features
              </h3>

              <div class="flex flex-col items-center flex-wrap lg:flex-row lg:items-stretch lg:flex-no-wrap lg:justify-between">
                <div class="w-full max-w-sm mt-6 lg:mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                  <div class="p-4 inline-block bg-indigo-200 rounded-lg">
                    <svg class="text-indigo-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                    </svg>
                  </div>
                  <div class="mt-4 font-extrabold text-2xl tracking-wide">
                    Transparent Donations
                  </div>
                  <div class="text-sm">
                    Our platform ensures that every donation is tracked and used effectively. You can see exactly how your contributions are making a difference.
                  </div>
                </div>

                <div class="w-full max-w-sm mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                  <div class="p-4 inline-block bg-green-200 rounded-lg">
                    <svg class="text-green-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12l5 5L20 7"/>
                    </svg>
                  </div>
                  <div class="mt-4 font-extrabold text-2xl tracking-wide">
                    Easy Contributions
                  </div>
                  <div class="text-sm">
                    Contribute effortlessly with our user-friendly interface. Whether one-time or recurring donations, it’s quick and simple to make a difference.
                  </div>
                </div>

                <div class="w-full max-w-sm mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                  <div class="p-4 inline-block bg-red-200 rounded-lg">
                    <svg class="text-red-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 15a3 3 0 0 0-3 3v1H9v-1a3 3 0 0 0-3-3H4v5h16v-5h-2z"/>
                      <path d="M20 5h-3.6A4.6 4.6 0 0 0 12 1.4 4.6 4.6 0 0 0 8.6 5H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h15a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
                    </svg>
                  </div>
                  <div class="mt-4 font-extrabold text-2xl tracking-wide">
                    Secure Transactions
                  </div>
                  <div class="text-sm">
                    We use the latest encryption technology to ensure that all transactions are secure. Your personal information and donations are protected.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8 bg-indigo-100" id="blog-posts">
            <div class="max-w-screen-xl mx-auto">
              <div>
                <h3 class="leading-none font-black text-3xl">Last Campaigns</h3>
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
                                <img src="{{ $campaign->user->profile_picture ? url($campaign->user->profile_picture) : url('default.jpg') }}" alt="{{ $campaign->user->name }}" class="w-10 h-10 rounded-full mr-4">
                                <div>
                                    <div class="text-lg font-bold">{{ $campaign->title }}</div>
                                    <div class="mt-3 text-gray-900 text-xs">By: {{ $campaign->user->name }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                  @endforeach
                </div>
                  <div class="mt-8 text-center">
                    <a href="{{ route('campaigns.index') }}" class="px-6 py-3 bg-blue-600 text-white font-bold rounded hover:bg-blue-700 transition duration-300">
                      Show all campaigns
                    </a>
                  </div>
                    @endif
              </div>
            </div>
          </div>
@endsection
