<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="form-group">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Name:<b style="color: red">*</b></label>
                        <input type="text"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Name" wire:model.lazy="name">
                        @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
        
                    <div class="form-group">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Email:<b style="color: red">*</b></label>
                        <input type="email"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Email" wire:model.lazy="email">
                        @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
        
                    <div class="form-group">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Password:<b style="color: red">*</b></label>
                        <input type="text"
                            class="form-control"
                            id="exampleFormControlInput1" placeholder="Password" wire:model.lazy="password">
                        @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                                  
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Roles:<b style="color: red">*</b></label>
                         <select name="" id="" wire:model.lazy="role"  class="form-control">
                            
                               <option value="">Choisir un role</option>
                               @foreach ($roles as $item)
                               <option value="{{ $item->name }}">{{ $item->name }}</option>
                               @endforeach
                               
                         </select>
                        @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <footer>
                    <button  class="btn btn-danger" wire:click.prevent="close()"  data-dismiss="modal">
                    Annuler
                    </button>
                    <button wire:click.prevent="save()" type="button"
                        class="btn btn-success">
                        valider
                    </button>
                </footer>
            </div>

        </div>
         
    </div>
</div>