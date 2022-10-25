<div wire:ignore.self class="modal fade bs-example-modal-sm" id="modalrole" role="dialog" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <form enctype="multipart/form-data">
            <div class="modal-body">
              
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Role"
                            wire:model.lazy="name">
                        @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="closeModalPopover()" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>

                <button wire:click.prevent="store()" type="button" class="btn btn-primary">
                    Valider
                </button>
            </div>

           </div>
         </form>
    </div>
</div>