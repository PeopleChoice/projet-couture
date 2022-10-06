
<x-slot name="header">
    <h2 class="text-center">Commandes</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-8 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
       
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <b> Prénom & Nom : </b>  {{$clients['prenom']}}  {{$clients['nom']}}
            </div>
            <div>
                <b>Télèphone : </b>  {{$clients['mobile']}}  
            </div>
        
            <div>
                <b>Email : </b>  {{$clients['email']}}  
            </div>
        </div>
          <br><br>
           
            <div class="grid grid-cols-1">
               <div>
                @if($isModalOpen)
                @include('livewire.commande.create_commande')
                @endif
                @if($isModalOpens)
                @include('livewire.commande.show_commande')
                @endif
                @if($isModalOpenMensuration)
                @include('livewire.commande.mensuration')
                @endif
                @if($isModalOpenDeatille)
                @include('livewire.commande.detaille')
                @endif
               </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    {{-- <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/> --}}
                    <div class=" mx-auto text-gray-600 ">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 pl-2 pr-8 rounded-lg text-sm focus:outline-none"
                            type="search" name="search" placeholder="Search" wire:model="searchTerms">
                        
                    </div>
                </div>
                <div>
                 
                </div>
            
                <div>
                    <button wire:click="create()"
                    class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter une commande</button>
                    <button wire:click="openMensuration()"
                      class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3 content-end">Menusration</button>
                </div>
            </div>
         
            
           
            
            @if (sizeof($commandes) > 0)
             <div class="grid grid-cols-1">
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap" >
                            <thead>
                                <tr class="bg-gray-100">
                                    <th >No.</th>
                                    <th  class=" border px-4 py-2w-60">Date Commande</th>
                                    <th  class=" border px-4 py-2w-40">Date de livraison</th>
                                    <th  class="border px-4 py-2">libelle</th>
                                    <th  class="border px-4 py-2">Remise</th>
                                    <th  class="border px-4 py-2">Accompt</th>
                                    <th  class="w-40">Status</th>
                                    <th  class="border px-4 py-2">Action</th>
                                    <th  class="border px-4 py-2">Plus ?</th>
                                </tr>
                            </thead>
                            <tbody  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-200">
    
                                @foreach($commandes as $commande)
                                <tr>
                                    <td class="border px-4 py-2">{{ $commande->id }}</td>
                                    <td class="border px-4 py-2">{{ $commande->date_commande }}</td>
                                    <td class="border px-4 py-2">{{ $commande->date_livraison}}</td>
                                    <td class="border px-4 py-2">{{ $commande->libelle}}</td>
                                    <td class="border px-4 py-2">{{ $commande->remise}}</td>
                                    <td class="border px-4 py-2">{{ $commande->accompt  }}</td>
                                    @if($commande->status == "En cours")
                                    <td class="border px-7 py-2 font-bold text-green-900 ">
                                        <p class="bg-yellow-400 px-4"> En cours</p> 
    
                                    </td>
                                    @elseif($commande->status == "En confection")
                                    <td class="border px-7 py-2 font-bold text-white-400 ">
                                        <p class="bg-red-400 px-4">En confection</p> 
                                    </td>
                                    @else
                                    <td class="border px-7 py-2 font-bold text-white-400 ">
                                        <p class="bg-green-400 px-4">Terminé</p> 
                                    </td>
                                    @endif
                                    <td class="border px-4 py-2">
                                        <button wire:click="edit({{ $commande->id }})"
                                            class="bg-blue-500  text-white font-bold py-1 px-4 rounded">
                                        
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $commande->id }})"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    
                                    </td>
                                    <td class="border px-10 py-2">
                                        <button wire:click="addProduitCommande({{$commande->id}})"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                        <button wire:click="showCommande({{$commande->id}})"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                {{ $commandes->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
            @else
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">C'est un nouveau client</p>
            </div>
            @endif
        </div>
    </div>
</div>

