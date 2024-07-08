@extends('layouts.app')
@section('title', 'Thank You')
@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="flex justify-center mb-6">
                        <div class="relative w-16 h-16">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-green-500 animated-tick" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="tick-circle" cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    <path class="tick-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-center mb-4">Thank You for Your Donation! for</h1>
                    <p class="text-gray-700 text-center mb-6">We appreciate your generosity and support.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('home') }}" class="bg-green-500 text-white font-semibold py-2 px-4 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                            Go to Home
                        </a>
                    </div>
                </div>
                <ul class="text-center space-x-4 mt-2">
                    <p class="text-sm text-gray-700">You can download the invoice and thanking letter from <a href="{{ route('user.profile',['#donation']) }}" class="underline text-indigo-400">here</a></p>
                </ul>
            </div>
        </div>
    </div>

    <style>
        @keyframes tick-circle-animation {
            0% {
                stroke-dasharray: 0 62.83185307179586;
            }
            100% {
                stroke-dasharray: 62.83185307179586 0;
            }
        }

        @keyframes tick-path-animation {
            0% {
                stroke-dasharray: 0 12;
            }
            100% {
                stroke-dasharray: 12 0;
            }
        }

        .tick-circle {
            stroke-dasharray: 62.83185307179586 62.83185307179586;
            animation: tick-circle-animation 1s ease-out forwards;
        }

        .tick-path {
            stroke-dasharray: 12 12;
            animation: tick-path-animation 0.5s 1s ease-out forwards;
        }

        .animated-tick {
            stroke: #10b981;
            stroke-width: 2;
        }
    </style>
@endsection
