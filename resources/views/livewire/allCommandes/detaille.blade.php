<div wire:ignore.self class="modal fade bs-example-modal-lg" id="paniermodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Panier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @if (session()->has('ajout'))
                        <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p class="text-sm">{{ session('ajout') }}</p>
                        </div>
                        @endif
                        @if (session()->has('delete'))
                        <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p class="text-sm">{{ session('delete') }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        
                    
                        <div class="form-group" >
                            <input type="text" placeholder="Libellé" wire:model="libelle_detaille"  class="form-control">
                            @error('libelle_detaille') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="number" placeholder="Qt" wire:model="qt" class="form-control">
                            @error('qt') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="number" placeholder="Prix unitaire" wire:model="prix_u" class="form-control">
                            @error('prix_u') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        
                            <button class=" float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" wire:click="addArticleToDetaille()">
                                Ajouter
                            </button>
                    </div>
                    
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                     
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Qt</th>
                                    <th>Pu</th>
                                    <th>Prix Total</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach($detailles as $item)
                                <tr>
                                    <td>{{ $item->libelle }}</td>
                                    <td>{{ $item->qt }}</td>
                                    <td>{{ $item->prix_u}}</td>
                                    <td>{{ $item->qt * $item->prix_u}}</td>
                                    <td>
                                        <button wire:click="deleteDetaille({{ $item->id }})"
                                            class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div>
                            <p style="text-align: center">Total : <b>{{$totalDetaille}} f cfa</b></p>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button wire:click="closeModalDetaille()" type="button"
                                    class=" inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Fermer
                                </button>
                            </span>
                        </div>
                   </div>
                </div>
          </div>
     </div>
</div>
</div>