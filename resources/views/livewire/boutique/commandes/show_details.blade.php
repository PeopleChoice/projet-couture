<div

x-transition:enter="transition ease-out duration-150"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-150"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
>

<div x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0  transform translate-y-1/2" 
    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
    role="dialog" id="modal">
    <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->

    <!-- Modal body -->
    <div class="mt-4 mb-6">
        <!-- Modal title -->
        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Details
        </p>
        <!-- Modal description -->
        <p class="text-sm text-gray-700 dark:text-gray-400">
          
           <table class="w-full whitespace-no-wrap">
               <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th>Libelle</th>
                        <th>QT</th>
                        <th>Prix</th>
                        <th>Prix Total</th>
                    </tr>
               </thead>
               <tbody>
                        @php
                        $total = 0;
                        @endphp
                     @foreach ($details as $item)
                     
                       <tr class="text-gray-700 dark:text-gray-400">
                            @php
                               //dd($item);
                            $produit = App\Models\Produit::where('id',$item["id_produit"])->get()->toArray();
                            $total = $total + ($item["qt"] * $item["prix"]);
                            @endphp
                            <td class="px-4 py-3 text-sm"> 
                                {{ $produit[0]["libelle"] }}
                            </td>
                            <td class="px-4 py-3 text-sm"> 
                                {{ $item["qt"] }}
                            </td>
                            <td class="px-4 py-3 text-sm"> 
                                {{ $item["prix"] }}
                            </td>
                            <td class="px-4 py-3 text-sm"> 
                                {{ $item["qt"] * $item["prix"] }}
                            </td>
                        </tr>
                     @endforeach
                     <br>
                     <tr>
                         <td>
                             <p class="text-sm font-bold">Total avant remise : {{ $total }} </p>
                         </td>
                     </tr>
                     <tr>
                        <td>
                            <p class="text-sm font-bold">Remise : {{ $remise }} </p>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <p class="text-sm font-bold">Total aprés remise : {{ $total - $remise }} </p>
                        </td>
                    </tr>
               </tbody>
           </table>
         
            
        </p>
    </div>
    <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
        <button wire:click="close()"
            class="btn btn-danger">
           Fermer
        </button>
        <button wire:click="imprimer()"
            class="btn btn-primary">Imprimer
        </button>
    </footer>
</div>
</div>