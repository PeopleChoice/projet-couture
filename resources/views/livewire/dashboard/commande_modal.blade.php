<div class="modal fade"  tabindex="-1" role="dialog" id="modalcommandeC" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Commandes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
           
            <div class="modal-body">

                <div class="card-box table-responsive">
                   
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
        
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Date de livraison</th>
                            <th>libelle</th>
                            <th>Remise</th>
                            <th>Accompt</th>
                            <th>Prix Total</th>
                            <th>Status</th>
                            <th>Prénom & nom</th>
                            <th>Téléphone</th>
                            <th>Action</th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
        
                        @foreach($allCommande as $commande)
                     
                        <tr>
                            <td>{{ $commande->code }}</td>
                            <td>{{ $commande->date_livraison}}</td>
                            <td>{{ $commande->libelle}}</td>
                            <td>{{ $commande->remise}}</td>
                            <td>
                                
                                @php
                                    $acompte = 0;
                                    $prixtotal = 0;
                                    if(count($commande->acompte_commande) > 0)
                                    {
                                      foreach ($commande->acompte_commande as $key => $value) {
                                       $acompte = $acompte + (int) $value->prix;
                                       }
                                    }
                                    if(count($commande->detaille) > 0)
                                    {
                                       
                                        
                                        foreach ($commande->detaille as $key => $value) {
                                           
                                           $prixtotal = $prixtotal + ((int)$value->qt * (int)$value->prix_u);
                                       }
                                    }
                                   
                                @endphp
                                {{ $acompte }}
                            </td>
                            <td>
                                {{ $prixtotal }}
                            </td>
                            @if($commande->status == "En cours")
                            <td style="color: rgb(255, 170, 0);font-weight: bold">
                                 En cours 
        
                            </td>
                            @elseif($commande->status == "En confection")
                            <td style="color: red;font-weight: bold">
                                En confection
                            </td>
                            @elseif($commande->status == "Termine")
                                <td style="color: green;font-weight: bold">
                                    Terminé
                                </td>
                            @else
                                <td style="color: green;font-weight: bold">
                                    Livré
                                </td>
                            @endif
                            <td>{{ $commande->client->prenom  }} {{ $commande->client->nom  }}</td>
                            <td>{{ $commande->client->mobile  }}</td>
                            <td>
                                <select name="" id="" class="form-control" wire:model="status" wire:change="changeStatus({{ $commande->id }})">
                                    <option value="">Change status</option>
                                    <option value="Termine">Terminé</option>
                                    <option value="Livre">Livré</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 
                </div>
               
            </div>
        </div>
    </div>
</div>