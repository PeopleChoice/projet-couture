
<div class="row" wire:ignore.self>
    <div class="col-sm-12">
      
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
            @endif
    </div>  
    <div class="col-12">    
         <div>
            <b>Prénom & Nom : </b>  {{$prestataire['prenom']}}  {{$prestataire['nom']}}
         </div>
         <div>
            <b>Télèphone : </b>  {{$prestataire['mobile']}} 
         </div>
        <div>
            <b>Email : </b>  {{$prestataire['email']}}      
        </div>
              
                
    </div>
    <div class="col-sm-12"> 
            <?php
            
             $total = 0;
             $totalAcompte = 0;
             $rest = 0;
                if(sizeof($prestations) > 0){
                
                        foreach($prestations as $prestation){

                        
                     
                        $total = $total + ($prestation->qt * $prestation->prix);
                           
                       

                        if(count($prestation->acompte) > 0)
                        {
                            foreach ($prestation->acompte as $key => $value) {
                                $totalAcompte = (int)$totalAcompte + (int)$value->prix;
                            }
                        }else{
                            $totalAcompte = (int)$totalAcompte + 0;
                        }

                    }

                        
                
                        
                 }
             $rest = (int)$total- (int)$totalAcompte;
             $totalAcompte =  $rest !=0 ? $totalAcompte : 0 ;
              echo "<p style='text-align: end;font-size: 12px;font-weight: bold;margin-top:8px'>Total à payer :   ".$total." Franc cfa </p>";
              echo "<p style='text-align: end;font-size: 12px;font-weight: bold;margin-top:8px;color:green'>Acompte:   ".$totalAcompte." Franc cfa </p>";
              echo "<p style='text-align: end;font-size: 12px;font-weight: bold;margin-top:8px;color:red'>Reste à payer:   ".$rest." Franc cfa </p>";
            ?>
           
    </div>
    <div class="col-sm-12"> 
        <br><br>
            @can('ajouter_prestations')
            <button wire:click="create()"
                class="btn btn-success float-right">Ajouter prestation</button>  @endcan
        <br><br>
    </div>
    <div class="col-sm-12"> 
            @if($isModalOpen)
            @include('livewire.prestataire.create_detaille_prestation')
            @endif
            @include('livewire.prestataire.acompte_form')
            @if($isModalOpenList)
            @include('livewire.prestataire.acompte_list')
            @endif
    </div>     
            {{-- <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/>
           --}}
    <div class="col-sm-12"> 
            @if (sizeof($prestations) > 0)
           
                <div class="card-box table-responsive">
                <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        
                    <thead>
                        <tr>
                            <th >No.</th>
                            <th >Date Prestations</th>
                            <th >Titre</th>
                            <th >Prix</th>
                            <th >Qt</th>
                            <th >Prix Total</th>
                            <th >Status</th>
                            <th >Acompte</th>
                            <th >Reste à payer</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody >

                        @foreach($prestations as $prestation)
                        <tr>
                            <td >{{ $prestation->id }}</td>
                            <td >{{ $prestation->date_prestation }}</td>
                            <td >{{ $prestation->libelle}}</td>
                            <td >{{ $prestation->prix}}</td>
                            <td >{{ $prestation->qt}}</td>
                            <td >{{ (int)$prestation->qt * (int)$prestation->prix}}</td>
                            @php
                            $acompte = 0;
                             if(count($prestation->acompte) > 0)
                             {
                                foreach ($prestation->acompte as $key => $value) {
                                    $acompte = (int)$acompte + (int)$value->prix;
                                }
                             }
                             $restapayer = ((int)$prestation->qt * (int)$prestation->prix) - (int) $acompte;
                             @endphp
                            @if($restapayer != 0)
                            <td>
                                <p style="color : red"> Non Payée</p> 

                            </td>
                            @else
                            <td >
                                <p style="color : green">Payée</p> 
                            </td>
                            @endif
                            <td>
                              
                                <p class="bg-green-400 px-4">{{ (int)$acompte}}</p> 
                            </td>
                            <td class="border px-7 py-2 font-bold text-white-400 ">
                               
                                <p class="bg-green-400 px-4">{{ $restapayer}}</p> 
                            </td>
                            <td >
                                @can('modifier_prestations')
                                <button wire:click="edit({{ $prestation->id }})"
                                    class="btn btn-primary">
                                
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </button>
                                @endcan   
                                @can('supprimer_prestations')
                                <button wire:click="deleteDetaille({{ $prestation->id }})"
                                    class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                                @endcan  
                                
                                <button wire:click="addAcompte({{ $prestation->id }})"
                                    class="btn btn-success">
                                
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>

                                <button wire:click="showAcompteList({{ $prestation->id }})"
                                    class="btn btn-success">
                                
                                    <i class="fa fa-eye"></i>
                                </button>

                               
                            
                            </td>
                        
                        </tr>
                        @endforeach
                        {{ $prestations->links() }}
                    </tbody>
                </table>
                </div>
           
            @else
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">C'est un nouveau prestataire</p>
            </div>
            @endif
    </div>
   
</div>
@push('scripts')
    <script>
            Livewire.on('showModalprestataire',()=>{
                $("#modaldetailsprestataire").modal('show');
            })

            Livewire.on('hideModalprestataire',()=>{
                $("#modaldetailsprestataire").modal('hide');
            })
            Livewire.on('showModalacompte',()=>{
                $("#modalacompte").modal('show');
            })

            Livewire.on('hideModalacompte',()=>{
                $("#modalacompte").modal('hide');
            })


            Livewire.on('showModalacomptelist',()=>{
                $("#modalacomptelist").modal('show');
            })

            Livewire.on('hideModalacomptelist',()=>{
                $("#modalacomptelist").modal('hide');
            })
    </script>



@endpush

