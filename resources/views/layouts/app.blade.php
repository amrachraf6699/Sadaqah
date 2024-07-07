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


    <!-- alpine.js is used for handling toggle of navbar on mobile screens, switch it with your own front end framework
    if needed -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  </head>

  <body>
    <div class="py-2 bg-gray-100 text-gray-900 min-h-screen">

      <header class="px-5 sm:px-10 md:px-10 md:py-5 lg:px-20 flex items-center justify-between">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('logo.png') }}" class="w-10">
            </a>
        </div>
        <div x-data="{ navOpen: false }">
          <button @click="navOpen = true">
            <svg class="cursor-pointer text-gray-700 hover:text-gray-900 w-6 md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
          </button>
          <div :class="{'hidden': !navOpen}" class="md:block fixed top-0 inset-x-0 bg-white p-8 m-4 z-30 rounded-lg shadow md:rounded-none md:shadow-none md:p-0 md:m-0 md:relative md:bg-transparent">
            <button @click="navOpen = false" class="absolute top-0 right-0 mr-5 mt-5 md:hidden">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                <path d="M18 6L6 18M6 6l12 12"/>
              </svg>
            </button>
            <div class="flex flex-col md:flex-row items-center justify-center">
                <a href="https://github.com/amrachraf6699/sadaqah" target="_blank" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-red-500 border-transparent hover:border-red-500 hover:text-gray-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
                    <i class='bx bx-heart text-2xl'></i>
                </a>
                @auth
                    <div class="flex flex-col md:flex-row items-center">
                        <a class="transition-all duration-100 ease-in-out pb-1 border-b-2 {{ auth()->user()->balance > 0 ? 'text-green-400' : 'text-red-400' }} border-transparent hover:border-indigo-300 hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
                            <img src="{{ auth()->user()->profile_picture ? url(auth()->user()->profile_picture) : url('default.jpg') }}" class="w-8 h-8 rounded-full inline-block mr-2">
                            {{ auth()->user()->balance }} $
                        </a>
                        <a href="{{ route('user.profile') }}" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-indigo-500 border-transparent hover:border-indigo-300 hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
                            Profile
                        </a>
                        <a href="{{ route('user.profile', ['#campaigns']) }}" class="transition-all duration-100 ease-in-out pb-1 px-4 border-2 border-indigo-500 text-indigo-500 hover:border-indigo-300 hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0 rounded-full">
                            My Campaigns
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-indigo-500 border-transparent hover:border-indigo-300 hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
                                <i class='bx bx-bell text-2xl'></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden z-20">
                                <div class="py-2">
                                    @foreach (auth()->user()->notifications->take(3) as $notification)
                                        <a href="{{ route('user.notifications.show',['notification'=>$notification->id]) }}" class="block px-4 py-2 text-sm text-gray-800 {{ $notification->read_at ? '' : 'bg-gray-200' }} hover:bg-gray-300">
                                            <div class="flex justify-between items-center">
                                                <span>{{ Str::limit($notification->data['message'], 30) }}</span>
                                                <span class="text-xs text-gray-500">{{ $notification->created_at->format('M-d h:i A') }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="border-t border-gray-200">
                                    <a href="{{ route('user.notifications') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 text-center">Show All Notifications</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('logout') }}" class="md:ml-auto">
                            <button class="border border-transparent rounded-full font-semibold tracking-wide text-lg md:text-sm px-5 py-2 md:py-2 focus:outline-none focus:shadow-outline bg-indigo-600 text-gray-100 hover:bg-indigo-800 hover:text-gray-200 transition-all duration-300 ease-in-out my-4 md:my-0 w-full md:w-auto">
                                Logout
                            </button>
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-indigo-500 border-transparent hover:border-indigo-300 hover:text-indigo-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0">
                        Login
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="border border-transparent rounded font-semibold tracking-wide text-lg md:text-sm px-5 py-3 md:py-2 focus:outline-none focus:shadow-outline bg-indigo-600 text-gray-100 hover:bg-indigo-800 hover:text-gray-200 transition-all duration-300 ease-in-out my-4 md:my-0 w-full md:w-auto">
                            Sign Up
                        </button>
                    </a>
                @endauth
            </div>

          </div>
        </div>
      </header>

      <main>
        @yield('content')
      </main>

      <footer class="px-5 sm:px-10 md:px-20 py-8">
        <div class="flex flex-col items-center lg:flex-row-reverse justify-between">
          <div class="flex space-x-4 mt-4">
            <a href="https://facebook.com/amrachraf6690" target="_blank" class="text-indigo-600 hover:text-indigo-800">
              <i class='bx bxl-facebook text-2xl'></i>
            </a>
            <a href="https://wa.me/+201028751528" target="_blank" class="text-indigo-600 hover:text-indigo-800">
              <i class='bx bxl-whatsapp text-2xl'></i>
            </a>
            <a href="https://linkedin.com/in/amrachraf6690" target="_blank" class="text-indigo-600 hover:text-indigo-800">
              <i class='bx bxl-linkedin text-2xl'></i>
            </a>
            <a href="https://twitter.com/amrachraf6690" target="_blank" class="text-indigo-600 hover:text-indigo-800">
              <i class='bx bxl-twitter text-2xl'></i>
            </a>
          </div>
          <div class="mt-4">
            <img src="{{ asset('logo.png') }}" class="w-10 border rounded-full">
          </div>
          <div class="mt-4 text-xs font-bold text-gray-500">
            &copy; 2024 Sadaqah | Amr Achraf
          </div>
        </div>
      </footer>
    </div>
  </body>
@session('success')
    <script>
        Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){}
        }).showToast();
    </script>
@endsession
@if ($errors->any())
  <script>
    Toastify({
      text: "{{ $errors->first() }}",
      duration: 3000,
      close: true,
      gravity: "top",
      position: "center",
      stopOnFocus: true,
      style: {
        background: "linear-gradient(to right, #ff6b6b, #f06595)",
      },
      onClick: function(){}
    }).showToast();
  </script>

@endif
</html>

