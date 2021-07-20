


<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
           
          <br><br>
          @can('ajouter_depenses')
          <button wire:click="create()"
          class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter depense</button>

            @endcan
            
            @if($isModalOpenFormDepense)
                @include('livewire.depensefolder.create_depense')
            @endif
            
           
           
            <input type="date" class="justify-content-between" placeholder="Search par date..." wire:model="searchTerms"/>
            
            <p style="text-align: center;font-weight: bold;font-size: 17px;">Total :  {{$totalDepense}} Franc cfa</p>
            @if (sizeof($AllData) > 0)
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" >
                    <thead>
                        <tr class="bg-gray-100">
                            <th  class=" border px-4 py-2w-60">Date</th>
                            <th  class=" border px-4 py-2w-60">Libelle</th>
                            <th  class=" border px-4 py-2w-40">Description</th>
                            <th  class="border px-4 py-2">Qt</th>
                            <th  class="border px-4 py-2">Prix Unitaire</th>
                            <th  class="border px-4 py-2">Total</th>
                            <th  class="border px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @foreach($AllData as $depense)
                        <tr>
                            <td class="border px-4 py-2">{{ $depense->date_enreg }}</td>
                            <td class="border px-4 py-2">{{ $depense->libelle }}</td>
                            <td class="border px-4 py-2">{{ $depense->description}}</td>
                            <td class="border px-4 py-2">{{ $depense->qt}}</td>
                            <td class="border px-4 py-2">{{ $depense->prix}}</td>
                            <td class="border px-4 py-2">{{ $depense->qt * $depense->prix  }}</td>
                        
                            <td class="border px-4 py-2">
                                @can('modifier_depenses')
                                <button wire:click="edit({{ $depense->id }})"
                                    class="bg-blue-500  text-white font-bold py-1 px-4 rounded">
                                
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                @endcan
                                @can('supprimer_depenses')
                                
                                <button wire:click="delete({{ $depense->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                @endcan
                            
                            </td>
                            
                        </tr>
                        @endforeach
                        {{ $AllData->links() }}
                    </tbody>
                </table>
              </div>
            </div>
            @else
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">Pas de dépense</p>
            </div>
            @endif
        </div>
        </div>
    </div>
</div>