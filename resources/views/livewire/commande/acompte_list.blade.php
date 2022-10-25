<div wire:ignore.self class="modal fade bs-example-modal-md" id="modalacomptelist" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Acompte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">

                <div class="card-box table-responsive">
                    <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
               
                    <thead>
                        <tr>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($allAcompte as $item)
                        <tr>
                            <td>{{$item->prix}} f cfa</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>
                </div>
               
            </div>
        </div>
    </div>
</div>