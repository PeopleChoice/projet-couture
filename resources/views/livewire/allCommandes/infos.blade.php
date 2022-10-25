<div wire:ignore.self class="modal fade bs-example-modal-sm" id="infosClient" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Infos client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                @isset($clientInfos)
                    
                    <div class="row">
                        <div class="col-12">
                               <label for=""><b>Nom & Prenom : </b></label><label for=""> {{  $clientInfos->prenom }} {{ $clientInfos->nom }}</label>
                                
                        </div>
                        <div class="col-12">
                            <label for=""><b>Email : </b></label><label for=""> {{  $clientInfos->email }} </label>
            
                        </div>
                        <div class="col-12">
                            <label for=""><b>Téléphone : </b></label><label for="">{{  $clientInfos->mobile }} </label>
                        </div>
                        <div class="col-12">
                            <label for=""><b>Adresse : </b></label><label for="">{{  $clientInfos->adresse }}</label>
                        </div>
                    </div>
                 @endisset
            </div>
        </div>
    </div>
</div>