<div wire:ignore.self class="modal fade bs-example-modal-lg" id="modalshowcommande" tabindex="-1" role="dialog" aria-labelledby="modalshowcommande" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-6">
                            <p style="text-align: left">
                                Date commande
                            </p>
                            <p style="text-align: left">
                                {{ $mycommande->date_commande }}
                            </p>
                        </div>
                        <div class="col-6">
                            <p style="text-align: right">
                                Date de livraison
                            </p>
                            <p style="text-align: right">
                                {{ $mycommande->date_livraison }}
                            </p>
                        </div>
                        <br><br><br>
                        <div class="col-12">
                            <p style="text-align: center;font-weight: bold;font-size: 17px">
                                 {{ $mycommande->libelle }}
                            </p>
                        
                        </div>
                        <br><br>
                        <div class="col-12">
                            <div class="card-box table-responsive">
                            <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                           
                            
                                <thead>
                                    <tr>
                                        <th>Libellé</th>
                                        <th>Qt</th>
                                        <th>Pu</th>
                                        <th>Prix Total</th>

                                    </tr>

                                </thead>
                                <tbody>

                                    @foreach ($mycommande->detaille as $item)
                                        <tr>
                                            <td>{{ $item->libelle }}</td>
                                            <td>{{ $item->qt }}</td>
                                            <td>{{ $item->prix_u }}</td>
                                            <td>{{ $item->qt * $item->prix_u }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <br>
                               <div class="divider"></div>
                               <br>
                        </div>
                        <div class="col-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Total
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $totalDetaille - $mycommande->remise }} f cfa
                            </dd>
                        </div>
                        <div class="col-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Accompte
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{$totalacompte }} f cfa
                            </dd>
                        </div>
                        <div class="col-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Remise
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $mycommande->remise }} f cfa
                            </dd>
                        </div>
                        <div class="col-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Reste à payer
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $totalDetaille - $mycommande->remise - (int) $totalacompte }} f cfa
                            </dd>
                        </div>
                        @if ($mycommande->status == "En cours")
                               <div class="col-4">
                                <dt class="text-sm font-medium text-gray-500">
                                    Status
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    <p><b> <span class="bg-warning"> En cours </span></b>&nbsp;&nbsp;
                                        @if ($totalDetaille - $mycommande->remise == $totalacompte)
                                            <span class="bg-success"> Payé </span>
                                        @else
                                            <span class="bg-danger"> Non Payé</span>
                                        @endif
                                    </p>

                                </dd>
                            </div>
                        @elseif($mycommande->status == "En confection")
                        <div class="col-4">
                            <dt class="text-sm font-medium text-gray-500">
                                Status
                            </dt>
                            <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                <p><b> <span class="bg-danger"> En confection </span></b>&nbsp;&nbsp;
                                    @if ($totalDetaille - $mycommande->remise == $totalacompte)
                                        <span class="bg-success"> Payé </span>
                                    @else
                                        <span class="bg-danger"> Non Payé</span>
                                    @endif
                                </p>

                            </dd>
                        </div>
                        @else
                        <div class="col-4">
                                <dt class="text-sm font-medium text-gray-500">
                                    Status
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    <p><span class="bg-success"> Terminé </span>&nbsp;&nbsp;
                                        @if ($totalDetaille - $mycommande->remise == $totalacompte)
                                            <span class="bg-success"> Payé </span>
                                        @else
                                            <span class="bg-success"> Non Payé</span>
                                        @endif
                                    </p>
                                </dd>
                            </div>
                        @endif
                        <div class="col-12">
                            <br>
                               <div class="divider"></div>
                               <br>
                        </div>
                       
                        <div class="col-6">

                         
                                <button wire:click="closeModalPopovershow()" type="button"
                                    class="btn btn-danger float-left">
                                    Fermer
                                </button>
                         

                        </div>
                        <div class="col-6">
                           
                          
                                <button  type="button" id="imprimer" formtarget="_blank" wire:click="imprimer({{ $mycommande->id }})"
                                    class="btn btn-primary float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                </button>
                         

                        </div>


                    </div>
                
            </div>




        </div>
    </div>
</div>

