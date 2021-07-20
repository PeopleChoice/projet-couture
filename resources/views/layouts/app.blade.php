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
  
    {{-- <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  /> --}}
  <link rel="stylesheet" href="{{ asset("css/tailwind.output.css")}}" />
  <link href="{{ asset('table/datatables.min.css') }}" rel="stylesheet"> 
  {{-- <script  src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer  ></script> --}}
  <script src="{{ asset('js/init-alpine.js')}}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/focus-trap.js') }}" defer></script>
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
   
    @stack('style')
    @livewireStyles

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
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
    {{-- <script src="{{ asset('table/jquery/jquery.min.js') }}"></script> 
    <script src="{{ asset('table/datatables.min.js') }}"></script> 
    <script>
         $(document).ready(function(){
			
            $('#example').DataTable({ responsive: true });
            
          });

    </script> --}}
    @stack('modals')
    @stack('scripts')
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/apexcharts/3.22.2/apexcharts.min.js" integrity="sha512-MaTc94UwSWnpm+S76wtgEHwUsQa3P8ed8iqgCmVHJMxfrDdF0/+2Ji/T7wAE4UZqIEapiG+g9kPaKZ6bMJtuPg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/apexcharts/3.22.2/apexcharts.min.css" integrity="sha512-H6KANMpZQKsK9c09UqdcQv02JTiZ/hMVwxkcbDLrp125CR884wwEdnWDm+Yuo6tihuC/cizLYWAjMZi0xAfGig==" crossorigin="anonymous" /> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
  
</body>
</html>
