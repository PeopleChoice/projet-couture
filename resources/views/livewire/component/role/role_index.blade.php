

<div class="row" wire:ignore.self>
    <div class="col-12">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
              
            @endif
          
            @include('livewire.component.role.create_role')
            
    

            @can('ajouter_roles')
                    <button type="button" wire:click="create()"
                             class="btn btn-success float-right">
                        Ajouter role
                    </button>
            @endcan

            <br><br><br>


          
            @forelse ($roles as $role)
               
                <form wire:submit.prevent="update({{$role->id}})"  method="POST" >
                
                    @if($role->name === 'Admin')
            
                            @include('livewire.component.role._permissions', [
                                'identity'=>$role->name,
                                'role_id'=>$role->id,
                                'title' => $role->name .' Permissions',
                                'options' => true ])  
                    @else
                            @include('livewire.component.role._permissions', [
                                'identity'=>$role->name,
                                'role_id'=>$role->id,
                                'title' => $role->name .' Permissions',
                                'options' => false ])  
                    @endif
                
                </form>
                 @empty
                <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                

          
        
             @endforelse
        </div>

       
    </div>
<div>
@push('scripts')
      <script>
               Livewire.on('showModal',()=>{
                   $("#modalrole").modal('show');
              })

              Livewire.on('hideModal',()=>{
                   $("#modalrole").modal('hide');
              })
      </script>
@endpush