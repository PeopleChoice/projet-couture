<div class="grid grid-cols-1 md:grid-cols-2">


    <div>
        <h1>Somme des depenses</h1>
        <p><b>{{ $sommes }} Franc cfa</b></p>
    </div>


    <div>



        <div class="flex">
            <div class="w-1/3">
                <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold ">Date debut:</label>
                <input type="date" class="justify-content-between" placeholder="Search par date..."
                    wire:model="date_debut"  />

            </div>
            <div class="w-1/3">

                <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold">Date Fin:</label>
                <input type="date" class="justify-content-between" placeholder="Search par date..."
                    wire:model="date_fin" />
            </div>
            <div class="w-1/3">

                <button wire:click="filter()"   class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5 mt-5">Filter</button>
            </div>
      
        </div>


    </div>

</div>
<br><br>
<div class="grid grid-cols-1 md:grid-cols-1">
  

    <table class="w-full whitespace-no-wrap" >
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
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" >
     
        
            @foreach($this->depenses as $depense)
           
            <tr>
                <td class="border px-4 py-2">{{ $depense["date_enreg"]  }}</td>
                <td class="border px-4 py-2">{{ $depense["libelle"]  }}</td>
                <td class="border px-4 py-2">{{ $depense["description"] }}</td>
                <td class="border px-4 py-2">{{ $depense["qt"] }}</td>
                <td class="border px-4 py-2">{{ $depense["prix"]}}</td>
                <td class="border px-4 py-2">{{ $depense["qt"]  * $depense["prix"]  }}</td>
          
                
            </tr>
            @endforeach
     
        </tbody>
    </table>
  
  
</div>