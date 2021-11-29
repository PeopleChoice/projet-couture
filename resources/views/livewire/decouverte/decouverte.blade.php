<x-slot name="header">
    <h2 class="text-center">Découvertes</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-8 lg:px-10">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
          
          <br><br>
            @can('ajouter_decouvertes')
              <button wire:click="create()"
                  class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter une image</button>
            @endcan
            @if($isModalOpen)
            @include('livewire.decouverte.createModale')
            @endif
            @if($isModalImage)
            @include('livewire.decouverte.showImage')
            @endif
        
            <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/>
           
            {{-- <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <!--Card 1-->
                @foreach($AllData as $decouverte)
                
                @php
                
                    $recup =  explode(".",$decouverte->image);
                    if(strtoupper($recup[1]) == "JPG"){
                      $recup[1] = 1;
                    }else if(strtoupper($recup[1]) =="JPEG"){
                      $recup[1] = 2;
                    }else{
                      $recup[1] = 3;
                    }
                @endphp

                <button class="rounded overflow-hidden shadow-lg" wire:click="openImage({{$recup[0]}} , {{$recup[1]}})" >
                  <img class="object-contain h-48  w-full zoom"  src="{{asset('storage/images/'.$decouverte->image)}}"  >
                  <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$decouverte->libelle}}</div>
                    <p class="text-gray-700 text-base">
                        {{$decouverte->description}}
                    </p>
                  </div>
                
                </button>

                @endforeach
               
                <!--Card 2-->
               
              </div>
            </div>
              {{ $AllData->links() }} --}}

            {{-- debut --}}

            <main class="my-8">
              <div class="container mx-auto px-6">
                  {{-- <h3 class="text-gray-700 text-2xl font-medium">Wrist Watch</h3>
                  <span class="mt-3 text-sm text-gray-500">200+ Products</span> --}}
                  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    @foreach($AllData as $decouverte)
                    
                            @php
                            
                                $recup =  explode(".",$decouverte->image);
                                if(strtoupper($recup[1]) == "JPG"){
                                  $recup[1] = 1;
                                }else if(strtoupper($recup[1]) =="JPEG"){
                                  $recup[1] = 2;
                                }else{
                                  $recup[1] = 3;
                                }
                              @endphp
                          <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden" wire:click="openImage({{$recup[0]}} , {{$recup[1]}})">
                              <div class="flex items-end justify-end h-80 w-full bg-cover" style="background-image: url({{asset('storage/images/'.$decouverte->image)}})">
                                 
                              </div>
                              <div class="px-5 py-3">
                                  <h3 class="text-gray-700 uppercase">{{$decouverte->libelle}}</h3>
                                  <span class="text-gray-500 mt-2"> {{$decouverte->description}}</span>
                              </div>
                          </div>

                      @endforeach
                   
                          
                  </div>
                  <div class="flex justify-center">
                      <div class="flex rounded-md mt-8">
                        {{ $AllData->links() }} 
                      </div>
                  </div>
              </div>
          </main>

            {{-- fin --}}

            </div>
     
        </div>
    </div>
</div>




{{-- 

<main class="my-8">
  <div class="container mx-auto px-6">
      <h3 class="text-gray-700 text-2xl font-medium">Wrist Watch</h3>
      <span class="mt-3 text-sm text-gray-500">200+ Products</span>
      <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
          <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
              <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                  <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                  </button>
              </div>
              <div class="px-5 py-3">
                  <h3 class="text-gray-700 uppercase">Classic watch</h3>
                  <span class="text-gray-500 mt-2">$123</span>
              </div>
          </div>
       
              
      </div>
      <div class="flex justify-center">
          <div class="flex rounded-md mt-8">
            {{ $AllData->links() }} 
          </div>
      </div>
  </div>
</main> --}}