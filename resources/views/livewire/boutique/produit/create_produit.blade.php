


<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalproduit" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Produits</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
        <form>
            <div class="row">
                          
            
                    <div class="col-12">
                        <label for="exampleFormControlInput1"
                        class="block text-gray-700 text-sm font-bold mb-2">Catégories:<b style="color: red">*</b></label>
                        <select name="categorie_id"  wire:model="categories_id"
                        class="form-control"
                        >
                            @foreach ($allCategorie as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Libellé produit:<b style="color: red">*</b></label>
                            <select name="" id="" wire:model="libelle" class="form-control">
                                @foreach ($libelle_array as $item)
                                <option value="{{ $item }}">{{ $item}}</option>
                                @endforeach
                            </select>
                       
                        @error('libelle') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>


                    <div class="col-12">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Taille:<b style="color: red">*</b></label>
                            <select name="" id="" wire:model="taille" class="form-control">
                                @foreach ($taille_array as $item)
                                <option value="{{ $item }}">{{ $item}}</option>
                                @endforeach
                            </select>
                       
                        @error('taille') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Qt en stock:<b style="color: red">*</b></label>
                        <input type="number"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Qt en stock" wire:model="qt">
                        @error('qt') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Prix unitaire:<b style="color: red">*</b></label>
                        <input type="number"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Prix unitaire" wire:model="prix">
                        @error('prix') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Description:<b style="color: red">*</b></label>
                        <input type="text"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Description" wire:model="description">
                        @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <input type="file"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Image" wire:model="image">
                        @error('image') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                
            </div>
        </form>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="save()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Valider
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button wire:click="close()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Annuler
                    </button>
                </span>
            </div>
        
        </div>
    </div>
</div>
</div>