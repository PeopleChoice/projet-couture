<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalprestataire" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Prestation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                <form>
                   
                    <div class="row">
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Civ:<b style="color: red">*</b></label>
                            <select  class="form-control" wire:model="civ" id="exampleFormControlInput1">
                                <option value="Monsieur">Faite votre choix</option>
                                <option value="Monsieur">Monsieur</option>
                                <option value="Madame">Madame</option>
                                <option value="Mademoiselle">Mademoiselle</option>
                            </select>
                            @error('civ') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 fom-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                            <input type="text"
                                class="form-control"
                                id="exampleFormControlInput1" placeholder="Enter Name" wire:model="nom">
                            @error('nom') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Prenom:</label>
                            <input type="text"
                                class="form-control"
                                id="exampleFormControlInput1" placeholder="Enter Name" wire:model="prenom">
                            @error('prenom') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="text"
                                class="form-control"
                                id="exampleFormControlInput2" wire:model="email"
                                placeholder="Enter Email">
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Mobile:</label>
                                <input type="text"
                                class="form-control"
                                id="exampleFormControlInput2" wire:model="mobile"
                                placeholder="Enter Mobile">
                            @error('mobile') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> 
                        @if($date_naissance != 'edit')
                                    
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Date de naissance:<b style="color: red">*</b></label>
                            <input type="date"
                                class="form-control"
                                id="exampleFormControlInput1" placeholder="Date de naissance" wire:model="date_naissance">
                            @error('date_naissance') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>    
                        @endif   
                        <div class="col-12 fom-group" >
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Adresse:<b style="color: red">*</b></label>
                            <input type="text"
                                class="form-control"
                                id="exampleFormControlInput1" placeholder="Adresse" wire:model="adresse">
                            @error('adresse') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                 
                    </div>
                    
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="store()" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Valider
                            </button>
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


