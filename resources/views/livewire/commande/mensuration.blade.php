<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
           
                      {{-- **************************************** --}}
                      <!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Mensuration
      </h3>
    </div>
 
    <div class="border-t border-gray-200">
        <br><br>
        <div class="grid grid-cols-6 ml-5" >
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">COL:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.COL">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">EPAULE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.EPAULE">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">MANCHE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.MANCHE">
            </div>
            
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">POITRINE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.POITRINE">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">CEINTURE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.CEINTURE">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">BAS:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.BAS">
            </div>
        </div>

        <div class="grid grid-cols-6 ml-5">
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">TOUR DE VENTRE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.TOUR DE VENTRE">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">TOUR DE BRAS:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.TOUR DE BRAS">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">TOUR DE GENOU:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.TOUR DE GENOU">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">LONGUEUR BOUBOU:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.LONGUEUR BOUBOU">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">LONGEUR GENOU:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.LONGEUR GENOU">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">TOUR DE CUISSE:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.TOUR DE CUISSE">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">LONGUEUR PANTALON:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.LONGUEUR PANTALON">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">CARRURE DEVANT:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.CARRURE DEVANT">
            </div>
            <div>
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">CARRURE DOS:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.CARRURE DOS">
            </div>
            <div class="mt-4">
                <label for="exampleFormControlInput1"
                class="block text-gray-700 text-xs font-bold ">BASSIN:</label>
                <input type="text" class="shadow appearance-none border rounded w-10  py-1 px-1" wire:model="m.BASSIN">
            </div>
           
           
        </div>
        <div>
         <br><br>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button wire:click="closeModalMensuration()" type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    valider
                </button>
            </span>
       
          </div>
    </div>
  </div>

 </div>
    </div>
</div>