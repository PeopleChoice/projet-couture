<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalaffectation" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Affecter Commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
            <form>
              
                <div class="row">
                    
                        <div class="col-12 form-group">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Liste des Tailleurs:</label>
                                 <select  class="form-control" name="" wire:model.lazy="idTailleur" placeholder="Selection un tailleur" id="idTailleur">
                                     
                                       <option value="">Selectionner un tailleur</option>
                                        @foreach ($listeTailleurs as $item)
                                        <option value="{{ $item["id"] }}">{{ $item["name"] }}</option>
                                        @endforeach
                                        
                                   
                                    
                                 </select>
                          
                        </div>
                        
                </div>
               
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="validerAffectation()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Valider
                        </button>
                    </span>
                   
                </div>
            </form>
            </div>
        </div>
    </div>
</div>