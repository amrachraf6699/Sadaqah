<!DOCTYPE html>
<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Sadaqah - Reset Password</title>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <style>
        body {
            font-family: "Playwrite DE Grund", cursive;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="px-5 sm:px-10 md:px-10 md:py-5 lg:px-20 flex items-center justify-center bg-white shadow-md">
        <a href="{{ route('home') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8cypZp9xQE-ifK8deGkwkqDz3N8rDvxZ_EA&s" class="w-12 mt-2 mb-2 border rounded-full" alt="Company Logo">
        </a>
    </header>

    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h1 class="text-4xl text-center font-bold mb-4">Hello, {{ $name }}!</h1>

        <hr class="my-6 border-gray-300">

        <div class="p-6 border border-gray-200 rounded-lg text-center">
            <p class="text-lg mb-4 font-extrabold text-center">You are receiving this email because we received a password reset request for your account.</p>
            <p class="text-center mt-4 text-sm">Please click the button below to reset your password.</p>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/auth/reset', $token) }}?email={{ urlencode($email) }}" class="inline-block px-6 py-2 text-white bg-indigo-500 hover:bg-indigo-800 font-medium rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                Reset Password
            </a>
        </div>

        <p class="text-center mt-4 text-xs">If you did not request a password reset, no further action is required.</p>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} Sadaqah. All rights reserved.</p>
        <p>Don't hesitate to reach out to us at <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="underline">{{ env('MAIL_FROM_ADDRESS') }}</a> if you have any questions.</p>
    </footer>
</body>
</html>
