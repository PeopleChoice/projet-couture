
<div class="row" wire:ignore.self>

   
     <div class="col-12">
          @if (session()->has('message'))
          <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
              <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
              <p class="text-sm">{{ session('message') }}</p>
          </div>
          @endif
     </div>
      <div class="col-12">
        @can('ajouter_categories')
        <button wire:click="create()"
        class="btn btn-success  float-right">Ajouter Catégorie</button>
        @endcan
     </div>
     <div class="col-12">
          
          @include('livewire.boutique.categorie.create_categorie')
      
     </div>

     <div class="col-12">
      <div class="card-box table-responsive">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
              <tr>
                <th>N°</th>
                <th>Libelle</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
             @if (sizeof($allCategorie) > 0)
                 @foreach ($allCategorie as $item)
                 <tr>
                  <td>
                       {{ $item->id }}
                  </td>
                  <td>
                      {{ $item->libelle }}
                  </td>
                 
                  <td >
                    @can('modifier_categories')
                   
                      <button  wire:click="edit({{ $item->id }})"
                        class="btn btn-primary"
                        aria-label="Edit"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                      @endcan
                      @can('supprimer_categories')
                      <button  wire:click="delete({{ $item->id }})"
                        class="btn btn-danger"
                        aria-label="Delete"
                      >
                      <i class="fa fa-trash"></i>
                      </button>
                      @endcan
                    
                  </td>
                </tr>
                 @endforeach
                 {{ $allCategorie->links() }}
             @else
                  <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p class="text-sm">Pas de catégorie</p>
                </div>
             @endif
          
            </tbody>
        </table>
      </div>
          
     </div>
</div>

@push('scripts')
    
            Livewire.on('showModalacatgorie',()=>{
                $("#modalacatgorie").modal('show');
            })

            Livewire.on('hideModalacatgorie',()=>{
                $("#modalacatgorie").modal('hide');
            })

@endpush