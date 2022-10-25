<div class="row">
     <div class="col-12">
        <div style="background-color: #2a3f54;color:#fff ; padding : 5px">
            <p style="text-align: center">Somme des depenses</p>
            <p style="text-align: center" id="somme"><b>{{ $sommes }} Franc cfa</b></p>
        </div>
        <br><br>
     </div>
    
    <div class="col-4">
          <div class="form-group">
              <label for="">Date Debut</label>
              <input type="date" wire:model="date_debut" class="form-control">
          </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Date Fin</label>
            <input type="date" wire:model="date_fin" class="form-control">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Libellé</label>
            <select  class="form-control"  wire:model="libelle" id="exampleFormControlInput1">
                <option value="Monsieur">Faite votre choix</option>
                @foreach ($libellArray as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                <option value="new"><span class=" text-green-800 font-bold py-2 px-4 " >Ajouter un produit à la liste + </span></option>
             
               
            </select>
        </div>
    </div>
   
    <div class="col-12">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="bg-gray-100">
                    <th  class=" border px-4 py-2w-60">Date</th>
                    <th  class=" border px-4 py-2w-60">Libelle</th>
                    <th  class=" border px-4 py-2w-40">Description</th>
                    <th  class="border px-4 py-2">Qt</th>
                    <th  class="border px-4 py-2">Prix Unitaire</th>
                    <th  class="border px-4 py-2">Total</th>
               
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="body" >
             
               @if($depenses)
            
                @foreach($depenses as $depense)
               
                 <tr>
                    <td class="border px-4 py-2">{{  $depense["date_enreg"]  }}</td>
                    <td class="border px-4 py-2">{{ $depense["libelle"]  }}</td>
                    <td class="border px-4 py-2">{{ $depense["description"] }}</td>
                    <td class="border px-4 py-2">{{ $depense["qt"] }}</td>
                    <td class="border px-4 py-2">{{ $depense["prix"]}}</td>
                    <td class="border px-4 py-2">{{ $depense["qt"]  * $depense["prix"]  }}</td>
              
                    
                </tr> 
                @endforeach
             
                @endif
            </tbody>
        </table>
    </div>
</div>