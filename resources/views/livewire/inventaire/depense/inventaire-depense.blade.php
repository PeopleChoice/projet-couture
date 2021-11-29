




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
   
  <link rel="stylesheet" href="{{ asset("css/tailwind.output.css")}}" />
  <link href="{{ asset('table/datatables.min.css') }}" rel="stylesheet"> 
 
  <script src="{{ asset('js/init-alpine.js')}}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/focus-trap.js') }}" defer></script>
   
   
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
                         {{-- debut --}}

                         <div class="grid grid-cols-1 md:grid-cols-2">


                            <div>
                                <h1>Somme des depenses</h1>
                                <p id="somme"><b>{{ $sommes }} Franc cfa</b></p>
                            </div>
                        
                        
                            <div>
                        
                        
                        
                                <div class="flex">
                                    <div class="w-1/3">
                                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold ">Date debut:</label>
                                        <input type="date" class="justify-content-between" placeholder="Search par date..."
                                            id="date_debut"  />
                        
                                    </div>
                                    <div class="w-1/3">
                        
                                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold">Date Fin:</label>
                                        <input type="date" class="justify-content-between" placeholder="Search par date..."
                                           id="date_fin" />
                                    </div>
                                    <div class="w-1/3">
                        
                                        <button id="filter"   class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5 mt-5">Filter</button>
                                    </div>
                              
                                </div>
                        
                        
                            </div>
                        
                        </div>
                        <br><br>
                        
                        
                        <div class="grid grid-cols-1 md:grid-cols-1">
                          
                        
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th  class=" border px-4 py-2w-60">Date</th>
                                        <th  class=" border px-4 py-2w-60">Libelle</th>
                                        <th  class=" border px-4 py-2w-40">Description</th>
                                        <th  class="border px-4 py-2">Qt</th>
                                        <th  class="border px-4 py-2">Prix Unitaire</th>
                                        <th  class="border px-4 py-2">Total</th>
                                   
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="body" >
                                 
                                   @if($depenses)
                                
                                    @foreach($depenses as $depense)
                                   
                                     <tr>
                                        <td class="border px-4 py-2">{{  $depense["date_enreg"]  }}</td>
                                        <td class="border px-4 py-2">{{ $depense["libelle"]  }}</td>
                                        <td class="border px-4 py-2">{{ $depense["description"] }}</td>
                                        <td class="border px-4 py-2">{{ $depense["qt"] }}</td>
                                        <td class="border px-4 py-2">{{ $depense["prix"]}}</td>
                                        <td class="border px-4 py-2">{{ $depense["qt"]  * $depense["prix"]  }}</td>
                                  
                                        
                                    </tr> 
                                    @endforeach
                                 
                                    @endif
                                </tbody>
                            </table>
                          
                          
                        </div>

                         {{-- fin --}}
                         
                    </div>
                </main>
            </div>
       
        
    </div>
   
    @stack('modals')
    @stack('scripts')
  
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> 
    <script>


        $('#filter').click(()=>{
            var debut = $('#date_debut').val();
            var fin = $('#date_fin').val();

            if(debut == "" || fin == "")
        {
          swal.fire("Champ obligatoire", "Les champs date debut et date fin sont obligatoire :)", "error");
        }else{
          swal.fire({
                    title: 'Veuillez patienter quelques instants',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    timer: 20000,
                    onOpen: () => {
                        swal.showLoading();
                        $.ajax({
                        type:'GET',
                        url:"{{ route('filtre' )}}",
                        data:{"date_debut":debut,"date_fin":fin},
                        success:function(data) {

                                        if(data)
                                        {
                                            Swal.hideLoading();
                                        
                                            $('#body').html(data["content"]);
                                            $('#somme').html(data["total"]);
                                        
                                        }
                                     }
                            });
                    }
          });
        }
        });
        
    </script>
    
  
</body>
</html>
