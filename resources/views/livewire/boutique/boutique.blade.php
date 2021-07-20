<div class="py-12">
    @if (session()->has('message'))
    <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p class="text-sm">{{ session('message') }}</p>
    </div>
    <br>
    @endif
    @if ($showCommande)
        <div class="grid md:grid-cols-3 grid-cols-1">
            <div class="col-span-2 border-red-500">
                <div class="mx-4">
                    <select name="categorie_id" wire:model="categorie_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($allCategorie as $item)
                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="grid md:grid-cols-4 grid-cols-2 mx-4">
                    @foreach ($produits as $item)

                        <div
                            class="overflow-hidden shadow-lg rounded-lg h-50 md:h-50 w-36 md:w-44 cursor-pointer m-auto">
                            <a href="#" class="w-full block h-full" wire:click="addPanier({{ $item }})">
                                <img alt="blog photo" src="{{ asset('storage/images/' . $item->image) }}"
                                    class="max-h-44 w-full object-container" />
                                <div class="bg-white dark:bg-gray-800 w-full p-4">
                                    <p class="text-black-500 text-xs md:text-sm font-medium">
                                        {{ $item->libelle }}
                                    </p>
                                    <p class="text-red-700 dark:text-white text-xs md:text-base font-medium mb-2">
                                        {{ $item->prix }} f cfa
                                    </p>
                                    <p
                                        class="text-green-700 font-medium dark:text-gray-300 font-light text-xs md:text-md">
                                        Qt en stock : {{ $item->qt }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="grid grid-cols-1 mx-4" style="background-color: gray ">
                    <p class="text-xl" style="text-align: center;">PANIER</p>
                </div>
                <br>
                <div class="grid grid-cols-1 mx-4 text-xl">
                    <table>
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th>Libelle</th>
                                <th>Prix</th>
                                <th>Qt</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($panier as $item2)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="text-sm text-center">{{ $item2['libelle'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['prix'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['qt'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['prix'] * $item2['qt'] }}</td>
                                    <td class="text-sm text-center">
                                        <div class="grid grid-cols-2">
                                            <div>
                                                <button wire:click="addPanier1({{ $item2['id'] }})"
                                                    class="flex items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div>
                                                <button wire:click="delete({{ $item2['id'] }})"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Delete">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>
                                    @php
                                        $total = 0;
                                        
                                        foreach ($panier as $item) {
                                            $total = $total + $item['qt'] * $item['prix'];
                                        }
                                    @endphp
                                    <p class="text-base font-bold">Total : {{ $total }} Franc cfa</p>
                                </td>
                            </tr>
                        </tfooter>
                    </table>
                </div>

            </div>
        </div>
    @endif

    @if ($showpayement)
        <div class="grid md:grid-cols-6 grid-cols-1">
            <div class="col-span-3 border-red-500">
                <div class="grid grid-cols-1 mx-4" style="background-color: gray ">
                    <p class="text-xl" style="text-align: center;">PANIER</p>
                </div>
                <br>
                <div class="grid grid-cols-1 mx-4 text-xl">
                    <table>
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th>Libelle</th>
                                <th>Prix</th>
                                <th>Qt</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($panier as $item2)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="text-sm text-center">{{ $item2['libelle'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['prix'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['qt'] }}</td>
                                    <td class="text-sm text-center">{{ $item2['prix'] * $item2['qt'] }}</td>
                              
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>
                                    @php
                                        $total = 0;
                                        
                                        foreach ($panier as $item) {
                                            $total = $total + $item['qt'] * $item['prix'];
                                        }
                                    @endphp
                                   <p class="text-base font-bold">Total avant remise : {{$total }} Franc cfa</p>
                                </td>
                            </tr>
                        </tfooter>
                    </table>
                    <br><br><br>
                    <div class="mb-4">
                                                        
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Remise Globale:</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Remise Globale" wire:model="remise" wire:change="recupeChange()">
                        @error('remise') <span class="text-red-500">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4">
                        
                        <p class="text-base text-red-700 font-bold ">Total aprés remise : {{ $remise != 0 ? $total - $remise : $total }} Franc cfa</p>
                     </div>
                    
                </div>
            </div>

            <div class="col-span-3 border-red-500 mx-10">
                    <div class="grid grid-cols-1 mx-4" style="background-color: gray ">
                        <p class="text-xl" style="text-align: center;">INFOS CLIENTS</p>
                    </div>
                    <br>
                    <form action="">
                             <div class="mb-4">
                                                        
                                <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Nom:<b style="color: red">*</b></label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Nom" wire:model="nom">
                            @error('nom') <span class="text-red-500">{{ $message }}</span>@enderror
                             </div>
                             <div class="mb-4">
                                                        
                                <label for="exampleFormControlInput1"
                                    class="block text-gray-700 text-sm font-bold mb-2">Prenom:<b style="color: red">*</b></label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="prenom" wire:model="prenom">
                                @error('prenom') <span class="text-red-500">{{ $message }}</span>@enderror
                             </div>
                             <div class="mb-4">
                                                        
                                <label for="exampleFormControlInput1"
                                    class="block text-gray-700 text-sm font-bold mb-2">Adresse:<b style="color: red">*</b></label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="adresse" wire:model="adresse">
                                @error('adresse') <span class="text-red-500">{{ $message }}</span>@enderror
                             </div>
                             <div class="mb-4">
                                                        
                                <label for="exampleFormControlInput1"
                                    class="block text-gray-700 text-sm font-bold mb-2">Telephone:<b style="color: red">*</b></label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="telephone" wire:model="telephone">
                                @error('telephone') <span class="text-red-500">{{ $message }}</span>@enderror
                             </div>
                    </form>
            </div>
        </div>
    @endif

@if($isFirst)
    <div class="grid grid-cols-6 gap-4">
        <div class=""></div>
        <div class="col-span-4 "></div>
        <div class="">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r" wire:click="suivant()">
                Suivant
            </button>
        </div>
    </div>
@endif
@if ($isSeconde)
    <div class="grid grid-cols-6 gap-4">
        <div class="">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l" wire:click="retour()">
                Retour
            </button>
        </div>
        <div class="col-span-4 "></div>
        <div class="" >
            <button class="bg-green-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" wire:click="valider_commande()">
                Valider 
            </button>
           @if($isImprimer)
            <button class="bg-green-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded-r" wire:click="imprimer()">
                Imprimer
            </button>
            @endif
           
        </div>
@endif
</div>


