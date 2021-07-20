
<x-slot name="header">
    <h2 class="text-center">Prestations</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-8 lg:px-10">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
            <div>
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                 <b>Prénom & Nom : </b>  {{$prestataire['prenom']}}  {{$prestataire['nom']}} &nbsp;&nbsp; &nbsp;&nbsp; | &nbsp;&nbsp; &nbsp;&nbsp;<b>Télèphone : </b>  {{$prestataire['mobile']}}  
                &nbsp;&nbsp; &nbsp;&nbsp; | &nbsp;&nbsp; &nbsp;&nbsp;<b>Email : </b>  {{$prestataire['email']}}      
          </div>
          <div>
            <?php
            
             $total = 0;
             $totalAcompte = 0;
             $rest = 0;
                if(sizeof($prestations) > 0){
                
                        foreach($prestations as $prestation){

                        
                       // dd($prestation)
                        $total = $total + ($prestation->qt * $prestation->prix);
                        $totalAcompte = (int)$totalAcompte + (int)$prestation->acompte;
                        }

                        
                
                        
                 }
             $rest = (int)$total- (int)$totalAcompte;
              echo "<p style='text-align: end;font-size: 18px;font-weight: bold;margin-top:10px'>Total à payer :   ".$total." Franc cfa </p>";
              echo "<p style='text-align: end;font-size: 18px;font-weight: bold;margin-top:10px;color:green'>Acompte:   ".$totalAcompte." Franc cfa </p>";
              echo "<p style='text-align: end;font-size: 18px;font-weight: bold;margin-top:10px;color:red'>Reste à payer:   ".$rest." Franc cfa </p>";
            ?>
           
          </div>
          <br><br>
            @can('ajouter_prestations')
    
            <button wire:click="create()"
                class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter prestation</button>  @endcan
            @if($isModalOpen)
            @include('livewire.prestataire.create_detaille_prestation')
            @endif
           
            <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/>
          
            @if (sizeof($prestations) > 0)
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto"> 
            <table class="w-full whitespace-no-wrap" >
                <thead>
                    <tr class="bg-gray-100">
                        <th >No.</th>
                        <th  class=" border px-4 py-2w-60">Date Prestations</th>
                        <th  class="border px-4 py-2">Titre</th>
                        <th  class="border px-4 py-2">Prix</th>
                        <th  class="border px-4 py-2">Qt</th>
                        <th  class="border px-4 py-2">Prix Total</th>
                        <th  class="w-40">Status</th>
                        <th  class="w-40">Acompte</th>
                        <th  class="w-40">Reste à payer</th>
                        <th  class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-200">

                    @foreach($prestations as $prestation)
                    <tr>
                        <td class="border px-4 py-2">{{ $prestation->id }}</td>
                        <td class="border px-4 py-2">{{ $prestation->date_prestation }}</td>
                        <td class="border px-4 py-2">{{ $prestation->libelle}}</td>
                        <td class="border px-4 py-2">{{ $prestation->prix}}</td>
                        <td class="border px-4 py-2">{{ $prestation->qt}}</td>
                        <td class="border px-4 py-2">{{ (int)$prestation->qt * (int)$prestation->prix}}</td>
                        @if($prestation->status == 2)
                        <td class="border px-7 py-2 font-bold text-green-900 ">
                            <p class="bg-yellow-400 px-4"> Non Payée</p> 

                        </td>
                        @else
                        <td class="border px-7 py-2 font-bold text-white-400 ">
                            <p class="bg-green-400 px-4">Payée</p> 
                        </td>
                        @endif
                        <td>
                            <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="{{ $prestation->acompte}}" wire:change="changeacompte({{$prestation->id}},$event.target.value)">
                        </td>
                        <td class="border px-7 py-2 font-bold text-white-400 ">
                            <p class="bg-green-400 px-4">{{ ((int)$prestation->qt * (int)$prestation->prix) - (int)$prestation->acompte}}</p> 
                        </td>
                        <td class="border px-4 py-2">
                            @can('modifier_prestations')
                            <button wire:click="edit({{ $prestation->id }})"
                                class="bg-blue-500  text-white font-bold py-1 px-4 rounded">
                               
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                  </svg>
                            </button>
                            @endcan   
                            @can('supprimer_prestations')
                            <button wire:click="deleteDetaille({{ $prestation->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                  </svg>
                            </button>
                            @endcan   
                           
                        </td>
                       
                    </tr>
                    @endforeach
                    {{ $prestations->links() }}
                </tbody>
            </table>
        </div>
    </div>
            @else
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">C'est un nouveau prestataire</p>
            </div>
            @endif
        </div>
    </div>
</div>

