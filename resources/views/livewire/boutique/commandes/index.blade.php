<div class="row">
       <div class="col-12">
        @if (session()->has('message'))
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p class="text-sm">{{ session('message') }}</p>
        </div>
       
        @endif
       </div>
       <div class="col-12">
        @if($isModalShow)
        @include('livewire.boutique.commandes.show_details')
        @endif
  
       </div>
       <div class="col-12">
          <div class="card-box table-responsive" >
            <table  id="datatable-responsive" wire:key="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Date commande</th>
                  <th>Prénom</th>
                  <th>Nom</th>
                  <th>Téléphone</th>
                  <th>Email</th>
                  <th>Adresse</th>
        
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               @if (sizeof($commandes) > 0)
                   @foreach ($commandes as $item)
                   <tr>
                    <td>
                         {{ $item->id }}
                    </td>
                    <td>
                        {{ $item->date_commande }}
                   </td>
                    <td>
                        {{ $item->prenom }}
                    </td>
                    <td>
                        {{ $item->nom }}
                    </td>
                    <td>
                        {{ $item->tel }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        {{ $item->adresse }}
                    </td>
                    <td>
                      
                        <button  wire:click="show({{ $item->id }} , {{  $item->remise }})" class="btn btn-warning">
                           <i class="fa fa-eye"></i>
                        </button>
                     
                      </div>
                    </td>
                  </tr>
                   @endforeach
                   {{ $commandes->links() }}
               @else
                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                      <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                      <p class="text-sm">Pas de commandes</p>
                  </div>
               @endif
            
              </tbody>
            </table>
          </div>
       </div>
</div>

  