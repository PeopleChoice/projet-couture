<div wire:ignore.self class="modal fade bs-example-modal-md" id="modaldepense" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Dépense</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
            <form>
                
                    <div class="row">
                        @if($isShow)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="newProduit"  class="form-control" placeholder="ajouter new produit"   wire:model="newProduit"/>
                                    </div>
                                    <div class="col-2">
                                        <input type="button" value="ajouter"  wire:click="saveProduit()"   class="btn btn-danger">
                                    </div>
                                
                                </div>
                            
                            
                            </div>
                        @endif
                      
                        <div class="col-12 form-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Libellé:<b style="color: red">*</b></label>
                             <select  class="form-control" wire:change="addProduit()" wire:model="libelle" id="exampleFormControlInput1">
                                 <option value="Monsieur">Faite votre choix</option>
                                 @foreach ($libellArray as $item)
                                 <option value="{{$item}}">{{$item}}</option>
                                 @endforeach
                                 <option value="new"><span class=" text-green-800 font-bold py-2 px-4 " >Ajouter un produit à la liste + </span></option>
                              
                                
                             </select>
                             
                            @error('libelle') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Déscription:</label>
                                <textarea
                                class="form-control"
                                wire:model="description"
                                placeholder="Ajouter déscription"></textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Qt:</label>
                            <input type="number"
                                class="form-control"
                                placeholder="Ajouter qt" wire:model="qt">
                            @error('Qt') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Prix:</label>
                                <input type="number"
                                class="form-control"
                                placeholder="Ajouter le prix" wire:model="prix">
                            @error('prix') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                       
                                      
                    </div>
               
               
                 <br><br>
                <div class="col-12">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button"  aria-hidden="true"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Valider
                        </button>
                    </span>
                </div>
                <div class="col-12">
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"  aria-hidden="true"
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
