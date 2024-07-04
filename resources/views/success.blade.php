@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-4">Donation Successful</h1>
        <p class="text-lg">Thank you for your donation!</p>
        <p class="mt-4">Session ID: {{ $session->id }}</p>
    </div>
@endsection
