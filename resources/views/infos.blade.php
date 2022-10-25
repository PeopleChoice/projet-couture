<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <title>DHC FACTURE</title>

    <link href="{{ asset('/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    

</head>
<body>
       <div  style="width: 100%;">
                   <nav>
                        
                           <div style="background-color: #2a3f54;width:100%;height: 50px;">
                            <p style="text-align: center;padding-top: 10px;" class="relative text-white">Commande N° {{ $commande->id }}</p>
                           </div>
                                 
                         
                       
                   </nav>
                   <div class="row">
                    <div class="col-0 col-md-2"></div>
                    <div class="col-12 col-md-8" style="background-color: #e6e7e7;width: 50%;justify-content: center;" >
                       <div class="row">
                            <div class="col-12" style="font-size: 14px;font-weight: bold;">
                                 @if($commande->status == "En cours")
                                        <p style="text-align: center;color:rgb(234, 16, 23)"> En cours</p>
                                 @endif
                                 @if($commande->status == "En confection")
                                 <p style="text-align: center;color:orange"> En confection</p>
                                 @endif
                                 @if($commande->status == "Termine")
                                 <p style="text-align: center;color:rgb(0, 255, 38)"> Terminé</p>
                                 @endif
                                 @if($commande->status == "Livre")
                                 <p style="text-align: center;color:rgb(6, 176, 108)"> Livré</p>
                                 @endif
                            </div>
                              <div class="col-3">
                                <div class="justifiy-left">
                                    <img src="{{ asset('/images/logo.png') }}" style="width: 170px"/>
                                </div>
                              </div>
                              <div class="col-6"></div>
                              <div class="col-3">
                                <p style="text-align: right;font-family: Calibri" class="text-sm">Dakar, le {{ date("d/m/Y") }}</p>
                              </div>
                       </div>
                       <div class="row">
                             <div class="col-12" style="line-height: 5px">
                                <p style="text-align: center ;font-family: Calibri">Client</p>
                                <hr>
                                <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->prenom }} {{$commande->client->nom }} </p>
                                <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->mobile }}  </p>
                                <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->email }} </p>
                                <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->adresse }} </p>
                 
                             </div>
                             <div class="col-12">
                                <p style="text-align: center ;font-family: Calibri">Commande</p>
                                <hr>
                                <table class="table">
                                    <thead>
                                       
                                           <tr style="background-color: #2a3f54;color:#fff;text-align: center">
                                               <th style="font-family: Calibri"  >Libellé</th>
                                               <th style="font-family: Calibri" >Quantité</th>
                                               <th style="font-family: Calibri" >Prix unitaire</th>
                                               <th style="font-family: Calibri" >Prix total</th>
                                           </tr>
                                       
                                    </thead>
                                    <tbody>
                                         @foreach ($commande->detaille as $item)
                                             
                                             <tr>
                                               <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                                   {{ $item->libelle }}
                                               </td>
                                               <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                                   {{$item->qt }}
                                               </td>
                                               <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                                   {{ $item->prix_u }}
                                               </td>
                                               <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                                   {{ $item->qt  * $item->prix_u }}
                                               </td>
                                             </tr>
                                         @endforeach
                                    </tbody>
                   
                                </table>
                             </div>
                             <div class="col-12">
                                <hr>
                                <p class="text-sm" style="font-weight: bold;margin-left: 10%;text-align:center;font-family: Calibri" >
                                    Arrêtée la présente facture à la somme de : 
                                </p>
                                <p  class="text-sm" style="font-family: Calibri font-weight: bold;margin-left: 10%;text-align:center;font-family: Calibri" >  @php
                                   $nuts = new  App\Http\Livewire\Nuts($totalDetaille - $commande->remise , 'FR');
                                   echo $nuts->convert('fr-FR');
                                @endphp
                                </p>
                             </div>
                             <div class="col-6" style="line-height: 5px;">
                                <p style="font-family: Calibri" class="text-sm font-bold"> Détails réglement</p>
                                <p style="font-family: Calibri" class="text-sm"  >
                                  Total net à payé  :  {{ $totalDetaille - $commande->remise }} fcfa
                                </p>
                               <p style="font-family: Calibri" class="text-sm" >
                               Accompt : {{ $totalacommpte }}  fcfa
                               </p>
                              <p  style="font-family: Calibri" class="text-sm" >
                                  Remise : {{ $commande->remise }}  fcfa
                              </p>
                              <p   style="font-family: Calibri" class="text-sm"  >
                                  Reste à payé :  {{ (int)$totalDetaille - (int)$commande->remise - (int)$totalacommpte }} fcfa
                              </p>
                             </div>
                             <div class="col-6">
                                    <p style="text-align: center;font-weight: bold">Acomptes</p>
                                 
                                           <table class="table">
                                               <thead>
                                                    <tr>
                                                        <th>Somme</th>
                                                        <th>Date</th>
                                                    </tr>
                                               </thead>
                                               <tbody>
                                                @foreach ($commande->acompte_commande as $item)
                                                    <tr>
                                                            <td>{{ $item->prix }}</td>
                                                            <td>{{ $item->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                               </tbody>
                                           </table>
                                 
                             </div>
                       </div>
                       <div class="row">
                        
                       
                            
                              
                               <div style="margin-left: 15px;margin-top: 12px">
                                <p style="font-family: Calibri;font-size:13px ;font-weight: bold;"><b>Rendez-vous : </b> le {{$commande->date_livraison}}</p>
                                <p style="font-family: Calibri;font-size: 9px">
                                    NB: La maison dégage ses responsablités pour toute commande non retirée trois (3) mois <br> aprés la date de RV.  Nous vous remercions de votre compréhension et espérons vous revoir <br> trés bientôt.
                                </p>
                                <p style="font-family: Calibri;font-size: 9px;text-align: center;">
                                    Nord foire à  côté du terrain de basket - Dakar ,SENEGAL - Tél : 78 646 78 78 , Email : danehautecouture@gmail.com
                                 </p>
                                </div>
                             
                            
                        
                       </div>
                         
                    </div>
                    <div class="col-0 col-md-2"></div>
                   </div>
                 
       </div>
</body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
            footer {
                position: fixed; 
                bottom: 5px; 
                /* left: 0px; 
                right: 0px; */
                height: 100px; 

                /* text-align: center; */
                /* line-height: 35px; */
            }
    </style>
</head>
<body>
    
  <div class="min-h-screen">
    <div class="bg-white overflow-hidden shadow-xl">
        <div class="flex items-center max-w-max">
            <div id="corp">
                <div class="flex justifiy-left">
                    <img src="{{ asset('/images/logo.png') }}" class="w-24"/>
                    <p style="text-align: right;font-family: Calibri" class="text-sm">Dakar, le {{ date("d/m/Y") }}</p>
        
                </div>
              
               <p style="text-align: center ;font-family: Calibri">Client</p>
                <hr>
               
                <div class="mt-5">
                       <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->prenom }} {{$commande->client->nom }} </p>
                       <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->mobile }}  </p>
                       <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->email }} </p>
                       <p style="font-family: Calibri" class="text-sm ">{{ $commande->client->adresse }} </p>
        
                </div>
                <div class="w-full mt-5">
                    <p style="text-align: center ;font-family: Calibri">Code N° {{ $commande->id }}</p>
                    <hr>
                </div>
        
                <div  class="w-full mt-5">
                     <table class="w-full whitespace-no-wrap">
                         <thead>
                            
                                <tr class="bg-gray-100" style="background-color: rgb(216, 232, 247)">
                                    <th style="font-family: Calibri"  class="border-blue-500 px-4 text-sm  py-1">Libellé</th>
                                    <th style="font-family: Calibri" class="border-blue-500 px-4 text-sm  py-1">Quantité</th>
                                    <th style="font-family: Calibri" class="border-blue-500 px-4 text-sm  py-1">Prix unitaire</th>
                                    <th style="font-family: Calibri" class="border-blue-500 px-4 text-sm  py-1">Prix total</th>
                                </tr>
                            
                         </thead>
                         <tbody>
                              @foreach ($commande->detaille as $item)
                                  
                                  <tr>
                                    <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                        {{ $item->libelle }}
                                    </td>
                                    <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                        {{$item->qt }}
                                    </td>
                                    <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                        {{ $item->prix_u }}
                                    </td>
                                    <td style="font-family: Calibri;text-align: center"  class="px-4 py-1 text-sm"> 
                                        {{ $item->qt  * $item->prix_u }}
                                    </td>
                                  </tr>
                              @endforeach
                         </tbody>
        
                     </table>
                </div>
        
                <div  class="w-full mt-10">
                        <p class="text-sm" style="font-weight: bold;margin-left: 10%;text-align:center;font-family: Calibri" >
                            Arrêtée la présente facture à la somme de : 
                        </p>
                        <p  class="text-sm" style="font-family: Calibri font-weight: bold;margin-left: 10%;text-align:center;font-family: Calibri" >  @php
                           $nuts = new  App\Http\Livewire\Nuts($totalDetaille - $commande->remise , 'FR');
                           echo $nuts->convert('fr-FR');
                        @endphp
                        </p>
                </div>
               
                <div class="mt-5">
                     <p style="font-family: Calibri" class="text-sm font-bold"> Détails réglement</p>
                     <p style="font-family: Calibri" class="text-sm"  >
                       Total net à payé  :  {{ $totalDetaille - $commande->remise }} fcfa
                     </p>
                    <p style="font-family: Calibri" class="text-sm" >
                    Accompt : {{ $totalacommpte }}  fcfa
                    </p>
                   <p  style="font-family: Calibri" class="text-sm" >
                       Remise : {{ $commande->remise }}  fcfa
                   </p>
                   <p   style="font-family: Calibri" class="text-sm"  >
                       Reste à payé :  {{ (int)$totalDetaille - (int)$commande->remise - (int)$totalacommpte }} fcfa
                   </p>
                </div>    
             
        </div>
         <footer>
            <div  class=" flex w-full" >
              
               <div class="flex-auto justify-left pw-10">
                <p style="font-family: Calibri;font-size:13px ;font-weight: bold;"><b>Rendez-vous : </b> le {{$commande->date_livraison}}</p>
                <p style="font-family: Calibri;font-size: 9px">
                    NB: La maison dégage ses responsablités pour toute commande non retirée trois (3) mois <br> aprés la date de RV.  Nous vous remercions de votre compréhension et espérons vous revoir <br> trés bientôt.
                </p>
                <p style="font-family: Calibri;font-size: 9px;text-align: center;">
                    Nord foire à  côté du terrain de basket - Dakar ,SENEGAL - Tél : 78 646 78 78 , Email : danehautecouture@gmail.com
                 </p>
                </div>
                <div>
                 
               </div>
            </div>
         </footer>
        </div>
     </div>
  </div>
</body>
</html>
 --}}
