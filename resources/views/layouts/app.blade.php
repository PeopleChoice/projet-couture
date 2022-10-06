<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Projet Couture</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">  --}}
   
  <link rel="stylesheet" href="{{ asset("css/tailwind.output.css")}}" />
  <link href="{{ asset('table/datatables.min.css') }}" rel="stylesheet"> 
 
  <script src="{{ asset('js/init-alpine.js')}}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  {{-- <script src="{{ asset('js/focus-trap.js') }}" defer></script> --}}
   
   
    @stack('style')
    @livewireStyles

   
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
 
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script> 
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var swiper = new Swiper('.mySwiper', {
          spaceBetween: 30,
          centeredSlides: true,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      </script>
    
  
</body>
</html>
