<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{ asset("css/tailwind.output.css")}}" />
  <script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
  ></script>
  <script src="{{ asset('js/init-alpine.js')}}"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   
    @stack('style')
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body >
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900"  >
 
     
        @livewire('side-bar')
        
            <div class="flex flex-col flex-1 w-full">
                @livewire('header')
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        @livewire('navigation-menu')
                      
                        {{ $slot }}
                    </div>
                </main>
            </div>
       
        
    </div>
    @stack('modals')
    @stack('scripts')
   
    @livewireScripts
</body>
</html>
