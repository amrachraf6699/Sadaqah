<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Sadaqah - @yield('title')</title>
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
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8cypZp9xQE-ifK8deGkwkqDz3N8rDvxZ_EA&s" class="w-12 border rounded-full" alt="Company Logo">
        </a>
    </header>

    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h1 class="text-4xl text-center font-bold mb-4">Donation Received for {{ $campaign->title }}</h1>

        <hr class="my-6 border-gray-300">

        <div class="p-6 border border-gray-200 rounded-lg text-center">
            <h2 class="text-2xl mb-4 font-extrabold underline">Donation Details</h2>
            <div class="text-center">
                <p class="text-lg font-semibold mb-2">{{ $user->name }}</p>
                <p class="text-gray-600 mb-2">{{ $user->email }}</p>
                <p class="text-gray-600">Donated <span class="font-bold">${{ $amount }}</span> on {{ $campaign->created_at->format('F j, Y, g:i a') }}</p>
                <p class="text-gray-400 text-xs italic mt-4">{{ $note ? '" '.$note.' "' : '' }}</p>
            </div>
        </div>

        <p class="text-center mt-4 text-lg">If you have any questions or need further assistance, please don't hesitate to contact us.</p>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} Sadaqah. All rights reserved.</p>
        <p>Don't hesitate to reach out to us at <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="underline">{{ env('MAIL_FROM_ADDRESS') }}</a> if you have any questions.</p>
    </footer>
</body>
</html>
