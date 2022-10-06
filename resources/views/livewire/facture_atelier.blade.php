<!DOCTYPE html>
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
                left: 0px; 
                right: 0px;
                height: 100px; 

                /* text-align: center; */
                /* line-height: 35px; */
            }
    </style>
</head>
<body>
    
<div id="corp">
        <div class="flex justifiy-left">
            <img src="data:image/png;base64,{{ $image }}" class="w-24"/>
            <p style="text-align: right;font-family: Calibri" class="text-sm">Dakar, le {{ date("d/m/Y") }}</p>

        </div>
      
       <p style="text-align: center ;font-family: Calibri">Client</p>
        <hr>

        <div class="mt-5">
               <p style="font-family: Calibri" class="text-sm ">{{ $client->prenom }} {{$client->nom }} </p>
               <p style="font-family: Calibri" class="text-sm ">{{ $client->mobile }}  </p>
               <p style="font-family: Calibri" class="text-sm ">{{ $client->email }} </p>
               <p style="font-family: Calibri" class="text-sm "qz >{{ $client->adresse }} </p>

        </div>
        <div class="w-full mt-5">
            <p style="text-align: center ;font-family: Calibri">Facture N° {{ $mycommande->id }}</p>
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
                      @foreach ($mycommande->detaille as $item)
                          
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
                   $nuts = new  App\Http\Livewire\Nuts($totalDetaille - $mycommande->remise , 'FR');
                   echo $nuts->convert('fr-FR');
                @endphp
                </p>
        </div>
       
        <div class="mt-5">
             <p style="font-family: Calibri" class="text-sm font-bold"> Détails réglement</p>
             <p style="font-family: Calibri" class="text-sm"  >
               Total net à payé  :  {{ $totalDetaille - $mycommande->remise }} fcfa
             </p>
            <p style="font-family: Calibri" class="text-sm" >
            Accompt : {{ $mycommande->accompt }}  fcfa
            </p>
           <p  style="font-family: Calibri" class="text-sm" >
               Remise : {{ $mycommande->remise }}  fcfa
           </p>
           <p   style="font-family: Calibri" class="text-sm"  >
               Reste à payé :  {{ (int)$totalDetaille - (int)$mycommande->remise - (int)$mycommande->accompt }} fcfa
           </p>
        </div>    
        <div class="mt-5">
            <div class="flex">
                <div>
                  
                </div>
                <div>
                    <p class="text-sm font-bold" style="text-align: right;font-family: Calibri"> Signature</p>
                </div>
            </div>
        </div>  
</div>
 <footer>
    <div  class=" flex w-full" >
      
       <div class="flex-auto justify-left pw-10">
        <p style="font-family: Calibri;font-size:13px ;font-weight: bold;"><b>Rendez-vous : </b> le {{$mycommande->date_livraison}}</p>
        <p style="font-family: Calibri;font-size: 9px">
            NB: La maison dégage ses responsablités pour toute commande non retirée trois (3) mois <br> aprés la date de RV.  Nous vous remercions de votre compréhension et espérons vous revoir <br> trés bientôt.
        </p>
        <p style="font-family: Calibri;font-size: 9px;text-align: center;">
            Nord foire à  côté du terrain de basket - Dakar ,SENEGAL - Tél : 78 646 78 78 , Email : danehautecouture@gmail.com
         </p>
        </div>
        <div class="flex-auto justify-right">
            <p style="text-align: right"><img src="data:image/png;base64,{{ $qr }}" class="w-16"/><p>
       </div>
    </div>
 </footer>
</body>
</html>

