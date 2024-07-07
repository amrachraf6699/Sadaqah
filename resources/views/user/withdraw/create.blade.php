@extends('layouts.app')

@section('title', 'Request Withdrawal')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold mb-6 text-gray-900">Request Withdrawal</h2>

            <!-- Withdrawal Form -->
            <form action="" method="POST">
                @csrf

                <!-- Payment Method -->
                <div class="mb-6">
                    <label for="payment_method_id" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <select id="payment_method_id" name="payment_method_id" class="block w-full border @error('payment_method_id') border-red-300 @enderror rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                        <option value="">Select a payment method</option>
                        @foreach($payment_methods as $method)
                            <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                {{ $method->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0" class="block w-full border @error('amount') border-red-300 @enderror rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2" value="{{ old('amount') }}">
                </div>

                <!-- Identifier -->
                <div class="mb-6">
                    <label for="identifier" class="block text-sm font-medium text-gray-700 mb-2">Identifier</label>
                    <input type="text" id="identifier" name="identifier" class="block w-full border @error('identifier') border-red-300 @enderror rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        Request Withdrawal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
