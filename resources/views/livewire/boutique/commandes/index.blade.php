<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="grid md:grid-cols-2 grid-cols-1">
      <div class="flex justify-center md:justify-start ">
          <div>
            <input type="text" class="shadow appearance-none border rounded w-full  px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search ..." wire:model="searchTerms"/>
          </div>
      </div>
    
    </div>
  @if($isModalShow)
      @include('livewire.boutique.commandes.show_details')
  @endif

  <div class="w-full overflow-x-auto">
    @if (session()->has('message'))
    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p class="text-sm">{{ session('message') }}</p>
    </div>
   
    @endif
     
    

    <table id="example" class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">N°</th>
          <th class="px-4 py-3">Date commande</th>
          <th class="px-4 py-3">Prénom</th>
          <th class="px-4 py-3">Nom</th>
          <th class="px-4 py-3">Téléphone</th>
          <th class="px-4 py-3">Email</th>
          <th class="px-4 py-3">Adresse</th>

          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
       @if (sizeof($commandes) > 0)
           @foreach ($commandes as $item)
           <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">
                 {{ $item->id }}
            </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->date_commande }}
           </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->prenom }}
            </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->nom }}
            </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->tel }}
            </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->email }}
            </td>
            <td class="px-4 py-3 text-sm">
                {{ $item->adresse }}
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center space-x-4 text-sm">
                <button  wire:click="show({{ $item->id }} , {{  $item->remise }})"
                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                  aria-label="Edit"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
             
              </div>
            </td>
          </tr>
           @endforeach
           {{ $commandes->links() }}
       @else
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
              <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
              <p class="text-sm">Pas de commandes</p>
          </div>
       @endif
    
      </tbody>
    </table>
  </div>
</div>
