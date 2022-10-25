<div class="row">
     <div class="col-12">
        @if (session()->has('message'))
        <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p class="text-sm">{{ session('message') }}</p>
        </div>
        <br>
        @endif
     </div>
@if ($showCommande)
    <div class="col-md-6 col-12">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <select name="categorie_id" wire:model="categorie_id"
                                class="form-control">
                                @foreach ($allCategorie as $item)
                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select name="lib" wire:model="lib"
                                class="form-control">
                                @foreach ($libelle_array as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select name="taille" wire:model="taille"
                                class="form-control">
                                @foreach ($taille_array as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-12">
                  <div class="row">
                    
                        @foreach ($produits as $item)
                    
                          <div class="col-md-4 col-2" class="card" style="width: 130px;height: 100px">
                                <a href="#"  wire:click="addPanier({{ $item }})">
                                    <img style="width: 130px;height: 130px" src="{{ asset('storage/images/' . $item->image) }}"
                                        class="max-h-44 w-full object-container" />
                                    <div class="bg-white dark:bg-gray-800" style="width: 130px;">
                                        <p class="text-black-500 text-xs md:text-sm font-medium">
                                            {{ $item->libelle }}
                                        </p>
                                        <p class="text-red-700 dark:text-white text-xs md:text-base font-medium ">
                                            {{ $item->prix }} f cfa
                                        </p>
                                        <p class="text-red-700 dark:text-white text-xs md:text-base font-medium ">
                                            {{ $item->taille }}
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
        </div>
    </div>
    {{-- panier --}}
    <div class="col-md-6 col-12">
             <div class="row">
                     <div class="col-12">
                        <div  style="background-color: gray ">
                            <p class="text-xl " style="text-align: center;color:#fff">PANIER</p>
                        </div>
                     </div>
                    <div class="col-12">
                    
                        <div class="card-box table-responsive" >
                                <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                                   
                                        <thead>
                                            <tr>
                                                <th>Libelle</th>
                                                <th>Prix</th>
                                                <th>Qt</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($panier as $item2)
                                                <tr>
                                                    <td>{{ $item2['libelle'] }}</td>
                                                    <td>{{ $item2['prix'] }}</td>
                                                    <td>{{ $item2['qt'] }}</td>
                                                    <td>{{ $item2['prix'] * $item2['qt'] }}</td>
                                                    <td>
                                                       
                                                                <button wire:click="addPanier1({{ $item2['id'] }})" class="btn btn-success">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            
                                                                <button wire:click="delete({{ $item2['id'] }})"
                                                                    class="btn btn-danger">
                                                                  <i class="fa fa-trash"></i>
                                                                </button>
                                                        
                            
                            
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <footer>
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
                                        </footer>
                                    </table>
                        </div>
                       
                    </div>
             </div>
            

    </div>
    {{-- fin panier --}}
@endif
     {{-- panier suite --}}
@if ($showpayement)
<div class="col-12">
    
    <div class="row">
       
        <div class="col-md-6 col-12">
                    <div style="background-color: gray ">
                        <p class="text-xl" style="text-align: center;color:#fff">COMMANDE</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box table-responsive" >
                                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>Libelle</th>
                                            <th>Prix</th>
                                            <th>Qt</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($panier as $item2)
                                            <tr>
                                                <td>{{ $item2['libelle'] }}</td>
                                                <td>{{ $item2['prix'] }}</td>
                                                <td>{{ $item2['qt'] }}</td>
                                                <td>{{ $item2['prix'] * $item2['qt'] }}</td>
                                        
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <footer>
                                        <tr>
                                            <td>
                                                @php
                                                    $total = 0;
                                                    
                                                    foreach ($panier as $item) {
                                                        $total = (int)$total + (int)$item['qt'] * (int)$item['prix'];
                                                    }
                                                @endphp
                                            <p class="text-base font-bold">Total avant remise : {{$total }} Franc cfa</p>
                                            </td>
                                        </tr>
                                    </footer>
                                </table>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                        
                                <label for="exampleFormControlInput1"
                                    class="block text-gray-700 text-sm font-bold mb-2">Remise Globale:</label>
                                <input type="number"
                                    class="form-control"
                                    id="exampleFormControlInput1" placeholder="Remise Globale" wire:model="remise" wire:change="recupeChange()">
                                @error('remise') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>        
                        </div>
                        <div class="col-12">
                                <p class="text-base text-red-700 font-bold ">Total aprés remise : {{ (int)$remise != 0 ? (int)$total - (int)$remise : (int)$total }} Franc cfa</p>
                        </div>
                    </div>
        </div>
        <div class="col-md-6 col-12">
                <div style="background-color: gray ">
                    <p class="text-xl" style="text-align: center;color:#fff">INFOS CLIENT</p>
                </div>
                <form action="">
                    <div class="form-group">
                                            
                    <label for="exampleFormControlInput1"
                    class="block text-gray-700 text-sm font-bold mb-2">Nom:<b style="color: red">*</b></label>
                <input type="text"
                    class="form-control"
                    id="exampleFormControlInput1" placeholder="Nom" wire:model="nom">
                @error('nom') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                                            
                    <label for="exampleFormControlInput1"
                        class="block text-gray-700 text-sm font-bold mb-2">Prenom:<b style="color: red">*</b></label>
                    <input type="text"
                        class="form-control"
                        id="exampleFormControlInput1" placeholder="prenom" wire:model="prenom">
                    @error('prenom') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                                            
                    <label for="exampleFormControlInput1"
                        class="block text-gray-700 text-sm font-bold mb-2">Adresse:<b style="color: red">*</b></label>
                    <input type="text"
                        class="form-control"
                        id="exampleFormControlInput1" placeholder="adresse" wire:model="adresse">
                    @error('adresse') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                                            
                    <label for="exampleFormControlInput1"
                        class="block text-gray-700 text-sm font-bold mb-2">Telephone:<b style="color: red">*</b></label>
                    <input type="text"
                        class="form-control"
                        id="exampleFormControlInput1" placeholder="telephone" wire:model="telephone">
                    @error('telephone') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </form>
        </div>
    </div>
</div>
@endif

 {{-- panier suite fin --}}     

 <div class="col-12">
    @if($isFirst)
    <div class="row">
        <div class="col-6"></div>
        <div class="col-span-4 "></div>
        <div class="col-6">
            <button class="btn btn-success" wire:click="suivant()">
            Suivant
            </button>
        </div>
    </div>
    @endif
    @if ($isSeconde)
    <div class="row">
        <div class="col-6">
            <button class="btn btn-danger" wire:click="retour()">
            Retour
            </button>
        </div>
        <div class="col-span-4 "></div>
        <div class="col-6" >
            <button class="btn btn-success" wire:click="valider_commande()">
            Valider 
            </button>
            @if($isImprimer)
            <button class="btn btn-primary" wire:click="imprimer()">
            Imprimer
            </button>
            @endif
        </div>
    </div>
    @endif
</div>