<x-slot name="header">
    <h2 class="text-center">Découvertes</h2>
</x-slot>
<div class="py-12">
    <div class="grid md:grid-cols-2 grid-cols-1">
        <div class="flex justify-center md:justify-start ">
            <div>
              <input type="text" class="shadow appearance-none border rounded w-full  px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search ..." wire:model="searchTerms"/>
            </div>
        </div>
        <div class="flex justify-center md:justify-end">
          @can('ajouter_produits')
            <button wire:click="create()"
            class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter Produit</button>
        </div>
        @endcan
     </div>
     @if($isModalOpen)
        @include('livewire.boutique.produit.create_produit')
     @endif
    <div class="max-w-full mx-auto sm:px-8 lg:px-10">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
          
          <br><br>
           
         
        
            <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/>
           
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <!--Card 1-->
                <div class="grid grid-cols-1 md:grid-cols-4">

               
                @foreach($Produits as $item)
                
               
                <div >
                  <img class="object-contain h-48  w-full zoom"  src="{{asset('storage/images/'.$item->image)}}"  >
                  <div>
                    {{-- <div class="font-bold text-xl mb-2">{{$item->libelle}}</div> --}}
                    <p  style="text-align: center" class="font-bold text-gray-700 text-base">{{$item->libelle}}</p>
                    <p  style="text-align: center" class="text-gray-700 text-sm">PU : {{$item->prix}}</p>
                    <p  style="text-align: center" class="text-gray-700 text-sm">QT STOCK :{{$item->qt}}</p>
                  </div>
                  <div class="flex justify-center">
                       <div class="border-red-500">
                        @can('modifier_produits')
                        <button  wire:click="edit({{ $item->id }})"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                              ></path>
                            </svg>
                          </button>
                          @endcan
                       </div>
                       <div>
                        @can('supprimer_produits')
                        <button  wire:click="delete({{ $item->id }})"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </button>
                          @endcan
                       </div>
                  </div>
                </div>
                
    

                @endforeach
            </div>
                <!--Card 2-->
               
              </div>
            </div>
              {{ $Produits->links() }}
            </div>
     
        </div>
    </div>
</div>

