<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="icon" href="{{ asset('logo.png') }}">
    <style>
      body {
        @import url('https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap');
        font-family: "Playwrite DE Grund", cursive;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
      }

      header {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem 2rem;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      header img {
        width: 3rem;
        border-radius: 50%;
        border: 2px solid #ccc;
      }

      .container {
        max-width: 60rem;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
      }

      .text-center {
        text-align: center;
      }

      .text-lg {
        font-size: 1.125rem;
      }

      .text-xl {
        font-size: 1.25rem;
      }

      .font-semibold {
        font-weight: 600;
      }

      .text-teal-600 {
        color: #2a9d8f;
      }

      .text-gray-600 {
        color: #4a4a4a;
      }

      .text-gray-500 {
        color: #6b6b6b;
      }

      .text-right {
        text-align: right;
      }

      .mb-8 {
        margin-bottom: 2rem;
      }

      .mb-2 {
        margin-bottom: 0.5rem;
      }

      .mt-8 {
        margin-top: 2rem;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
      }

      th, td {
        padding: 0.5rem 1rem;
        border-bottom: 1px solid #e2e8f0;
      }

      th {
        background-color: #f1f5f9;
        color: #4a4a4a;
        text-align: left;
      }

      td.text-right {
        text-align: right;
      }

      a {
        text-decoration: none;
        color: #2a9d8f;
      }

      a:hover {
        text-decoration: underline;
      }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8cypZp9xQE-ifK8deGkwkqDz3N8rDvxZ_EA&s" alt="Company Logo">
        </a>
    </header>
    <div class="container">
        <div class="text-center mb-8">
            <h1 class="text-xl font-semibold text-teal-600">Sadaqah - Invoice {{ $campaign->donations[0]->id }}</h1>
            <p class="text-lg">{{ now()->format('Y-m-d h:i') }}</p>
        </div>

        <div class="mb-8">
            <p class="text-lg font-semibold">Billing To:</p>
            <p class="text-lg">{{ auth()->user()->name }}</p>
            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Donation</td>
                    <td class="text-right">${{ number_format($amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <p class="text-xl font-semibold text-right">Total: ${{ number_format($amount, 2) }}</p>

        <div class="text-center mt-8 text-gray-600">
            <p class="mb-2">Thank you for your support to {{ $campaign->title }}</p>
            <p class="mb-2">
                <a href="{{ route('home') }}">Our Website</a>
            </p>
        </div>
    </div>
</body>
</html>
