<div class="row" wire:ignore.self>


    @if (session()->has('message'))
    <div class="col-12 alert alert-success" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p class="text-sm">{{ session('message') }}</p>
    </div>

    @endif


    <div class="col-12">
        <div>
            
            @if($isModalOpens)
            @include('livewire.allCommandes.show_commande')
            @endif
            {{-- @if($isModalOpenMensuration) --}}
            @include('livewire.allCommandes.mensuration')
            {{-- @endif --}}
            @if($isModalOpenDeatille)
            @include('livewire.allCommandes.detaille')
            @endif
            {{-- @if ($isOpenModalAffectation) --}}
            @include('livewire.allCommandes.affectation')
            @include('livewire.allCommandes.infos');
            {{-- @endif --}}
        </div>
    </div>
  


    @if (sizeof($allCommande) > 0)
    <div class="col-12 card-box table-responsive">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Affectaion</th>
                    {{-- <th>Date Commande</th> --}}
                    <th>Date de livraison</th>
                    <th>libelle</th>
                    <th>Remise</th>
                    <th>Accompt</th>
                    <th>Prix Total</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Plus ?</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>

                @foreach($commandes as $commande)
               
                <tr>
                    <td>{{ $commande->code }}</td>
                    <td>
                         @if( Auth::user()->roles->pluck('name')->first() == "Admin" ||  Auth::user()->roles->pluck('name')->first() == "Gestionnaire")
                                
                            @if ($commande->status == "En cours")
                            <button class="btn btn-success" wire:click="affecter({{ $commande->id }})"><i class="fa fa-share"></i></button>
                            @endif
                         @endif
                    </td>
                    {{-- <td>{{ $commande->date_commande }}</td> --}}
                    <td>{{ $commande->date_livraison}}</td>
                    <td>{{ $commande->libelle}}</td>
                    <td>{{ $commande->remise}}</td>
                    <td>
                        
                        @php
                            $acompte = 0;
                            $prixtotal = 0;
                            if(count($commande->acompte_commande) > 0)
                            {
                              foreach ($commande->acompte_commande as $key => $value) {
                               $acompte = $acompte + (int) $value->prix;
                               }
                            }
                            if(count($commande->detaille) > 0)
                            {
                               
                                
                                foreach ($commande->detaille as $key => $value) {
                                   
                                   $prixtotal = $prixtotal + ((int)$value->qt * (int)$value->prix_u);
                               }
                            }
                           
                        @endphp
                        {{ $acompte }}
                    </td>
                    <td>
                        {{ $prixtotal }} 
                    </td>
                    @if($commande->status == "En cours")
                    <td style="color: rgb(255, 174, 0);font-weight: bold">
                         En cours 

                    </td>
                    @elseif($commande->status == "En confection")
                    <td style="color: red;font-weight: bold">
                        En confection
                    </td>
                    @elseif($commande->status == "Termine")
                    <td style="color: green;font-weight: bold">
                        Terminé 
                    </td>
                    @else
                    <td style="color: green;font-weight: bold">
                        Livré  
                    </td>
                    @endif
                    <td>
                        <button wire:click="openMensuration({{ $commande->clients_id }})" class="btn btn-primary">
                            Mesure
                        </button>
                        <button wire:click="infos({{ $commande->clients_id }})" class="btn btn-warning">
                            <i class="fa fa-info"></i>
                        </button>

                    </td>
                    <td>
                    
                        <button wire:click="facture({{$commande->id}},{{$commande->clients_id}})" class="btn btn-success">
                            <i class="fa fa-file-pdf-o"></i>
                        </button>

                        
                    </td>
                    <td>
                        <select name="" id="" class="form-control" wire:model="status" wire:change="changeStatus({{ $commande->id }})">
                            <option value="">Change status</option>
                            <option value="Termine">Terminé</option>
                            <option value="Livre">Livré</option>
                     </select>
                    </td>
                </tr>
                @endforeach
                {{-- {{ $commandes->links() }} --}}
            </tbody>
        </table>
    </div>
</div>

@else
<div class="col-12 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path
            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
    </svg>
    <p class="text-sm">C'est un nouveau client</p>
</div>
@endif
</div>
</div>
</div>


@push('scripts')

          
            
            Livewire.on('showModalmensuration',()=>{
                $("#modalmensuration").modal('show');
            })

            Livewire.on('hideModalmensuration',()=>{
                $("#modalmensuration").modal('hide');
            })

            Livewire.on('showModalpanier',()=>{
                $("#paniermodal").modal('show');
            })

            Livewire.on('hideModalpanier',()=>{
                $("#paniermodal").modal('hide');
            })
            Livewire.on('showModalaffectation',()=>{
                $("#modalaffectation").modal('show');
                
            })

            Livewire.on('hideModalaffectation',()=>{
                $("#modalaffectation").modal('hide');
            })

            
           



            Livewire.on('showModalshowcommande',()=>{
                $("#modalshowcommande").modal('show');
            })

            Livewire.on('hideModalshowcommande',()=>{
                $("#modalshowcommande").modal('hide');
            })


            Livewire.on('showModalinfosclient',()=>{
                $("#infosClient").modal('show');
            })

            Livewire.on('hideModalinfosclient',()=>{
                $("#infosClient").modal('hide');
            })




            
  
@endpush