
        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                    <p class="text-sm">{{ session('message') }}</p>
                    </div>
        
                @endif
            </div>
            <div class="col-sm-12 " >
                @can('ajouter_users')
                <button wire:click="create()"
                data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success float-right">Créer un utilisateur</button>
                @endcan
            </div>
        
            <div class="col-sm-12">
                @if($isModalOpen)
                     @include('livewire.users.create_user')
                @endif
            </div>
            <div class="col-sm-12" wire:ignore.self>
                <div class="card-box table-responsive">
                    <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr class="bg-gray-100">
                                <th >No.</th>
                                <th >Nom</th>
                                <th >Email</th>
                                <th >Role</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->roles->implode('name',',')}}</td>

                                <td>
                                    @can('modifier_users')
                                    <button wire:click="edit({{ $item->id }})"
                                        class="btn btn-primary">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                     </button>@endcan
                                        @can('supprimer_users')
                                        <button wire:click="delete({{$item->id }})"
                                        class="btn btn-danger">
                                         <i class="glyphicon glyphicon-trash"></i>
                                    </button>@endcan
                                
                                </td>
                            </tr>
                            @endforeach
                            {{-- {{ $users->links() }} --}}
                        </tbody>
                    </table>
                </div>
            </div>
    
       </div>

@push('scripts')
    <script>
            Livewire.on('showModal',()=>{
                $("#modalUser").modal('show');
            })

            Livewire.on('hideModal',()=>{
                $("#modalUser").modal('hide');
            })
    </script>
@endpush