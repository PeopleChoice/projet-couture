<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalcommande" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Commandes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
            <form enctype="multipart/form-data">
                        <p style='color:red;font-size:10px'>{{ $this->message }}</p> 
                        <div class=" form-group">
                          
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Date de livraison:<b style="color: red">*</b></label>
                            <input type="date"
                                class=" form-control"
                                id="exampleFormControlInput1" placeholder="Date de livraison" wire:model="date_livraison" wire:change="verif_date()">
                            @error('date_livraison') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
               
                        <div class=" form-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Libellé:<b style="color: red">*</b></label>
                            <input type="text"
                                class=" form-control"
                                id="exampleFormControlInput1" placeholder="Libellé" wire:model="libelle">
                            @error('libelle') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class=" form-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Remise:<b style="color: red">*</b></label>
                            <input type="number"
                                class=" form-control"
                                id="exampleFormControlInput1" placeholder="Remise" wire:model="remise">
                            @error('remise') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                       
                        <div class=" form-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Status:<b style="color: red">*</b></label>
                             <select    class=" form-control" wire:model="status" id="exampleFormControlInput1">
                                 <option value="En cours">Faite votre choix</option>
                                 <option value="En cours">En cours</option>
                                 <option value="Termine">Terminé</option>
                                 <option value="En confection">En confection</option>
                                 <option value="Livre">Livré</option>
                             </select>
                            @error('libelle') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                      

                   

                    
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            
                            Valider
                        </button>
                        @if($showSpiner)
                               <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                        @endif
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Annuler
                        </button>
                    </span>
                </div>
            </form>
           </div>
       </div>
   </div>
</div>
<script>

    window.livewire.on('fileChoosen',()=>{
            let inputField = document.getElementById('photo1');
            let file =  inputField.files[0];
            let reader =  new FileReader();
            reader.onloadend = () =>{
                
                 window.livewire.emit('fileUpload',reader.result)

            }
            reader.readAsDataURL(file);

    });
</script>