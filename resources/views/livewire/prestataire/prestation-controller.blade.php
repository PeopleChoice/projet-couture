
<div class="row" wire:ignore.self>
   
             <div class="col-12">
                @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
               
                @endif
             </div>
            <div class="col-sm-12">
                <button wire:click="create()"
                class="btn btn-success float-right">Ajouter</button>

            </div>
            @if($isModalOpen)
            @include('livewire.prestataire.create_prestataire')
            @endif
            {{-- <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/> --}}
            <div class="col-sm-12" wire:ignore.self>
                <div class="card-box table-responsive">
                    <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
            
                        <tr>
                            <th >No.</th>
                            <th >CIV</th>
                            <th >Nom</th>
                            <th >Prénom</th>
                            <th >Email</th>
                            <th >Mobile</th>
                            <th >Action</th>
                            <th >Commander</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($prestataires as $prestataire)
                        <tr>
                            <td>{{ $prestataire->civ }}</td>
                            <td>{{ $prestataire->id }}</td>
                            <td>{{ $prestataire->nom }}</td>
                            <td>{{ $prestataire->prenom}}</td>
                            <td>{{ $prestataire->email}}</td>
                            <td>{{ $prestataire->mobile}}</td>
                            <td>
                                <button wire:click="edit({{ $prestataire->id }})"
                                    class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                   </button>
                                <button wire:click="delete({{ $prestataire->id }})"
                                    class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            
                            </td>
                            <td class="border px-10 py-2">
                                <button wire:click="gotoDetails({{ $prestataire->id }})"
                                    class="btn btn-success">Mes prestations</button>
                            </td>
                        </tr>
                        @endforeach
                        {{-- {{ $prestataires->links() }} --}}
                    </tbody>
                    </table>
                </div>
            </div>
</div>



@push('scripts')
    <script>
            Livewire.on('showModalprestataire',()=>{
                $("#modalprestataire").modal('show');
            })

            Livewire.on('hideModalprestataire',()=>{
                $("#modalprestataire").modal('hide');
            })
    </script>
@endpush
