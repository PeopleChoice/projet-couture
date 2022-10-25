
<div class="row" wire:ignore.self>
    <div class="col-sm-12">
      
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
          
         
          
            @if($isModalOpen)
            @include('livewire.decouverte.createModale')
            @endif
            @if($isModalImage)
            @include('livewire.decouverte.showImage')
            @endif
        
            
           
            <div class="row">
               <div class="col-6">
                <div class="form-group">
                  <input
                      class="form-control rounded-4"
                      type="search" name="search" placeholder="Search" wire:model="searchTerms">
                  
                 </div>
               </div>
              
               <div class="col-6">
                  @can('ajouter_decouvertes')
                  <button wire:click="create()"
                      class="btn btn-success float-right">Ajouter</button>
                  @endcan
               </div>
            </div>


          
                      <div class="row">
            
                       
                     
                    
                        @foreach($AllData as $decouverte)
                             
                                @php
                                  
                                    $recup =  explode(".",$decouverte->image);
                                    if(strtoupper($recup[1]) == "JPG"){
                                      $recup[1] = 1;
                                    }else if(strtoupper($recup[1]) =="JPEG"){
                                      $recup[1] = 2;
                                    }else{
                                      $recup[1] = 3;
                                    }
                                  @endphp
                           
                                <div class="col-sm-1 col-md-4 col-lg">
                                    <div class="hover_green">
                                      <div class="card"  wire:click="openImage({{$recup[0]}} , {{$recup[1]}})" style="background-image: url({{asset('storage/images/'.$decouverte->image)}});width: 18rem;height:400px">
                                        <div class="grid place-items-center hover:bg-green-100 hover:opacity-50 h-80 w-full ">
                                             
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-0 hover:opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              
                          @endforeach
                           
                              
                      
                     
                 
              
               </div>
                

            

             <div class="flex justify-center">
              <div class="flex rounded-md mt-8">
                {{ $AllData->links() }} 
              </div>
             </div> 

          

            </div>
     
        
    </div>
</div>
@push('scripts')

               Livewire.on('showModalImage',()=>{
                   $("#modalImage").modal('show');
              })

              Livewire.on('hideModalImage',()=>{
                   $("#modalImage").modal('hide');
              })


              Livewire.on('showModaladdImage',()=>{
                   $("#modaladdimage").modal('show');
              })

              Livewire.on('hideModaladdImage',()=>{
                   $("#modaladdimage").modal('hide');
              })
     
@endpush

  