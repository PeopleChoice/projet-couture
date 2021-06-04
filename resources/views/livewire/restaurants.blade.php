
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-8 lg:px-10">
        @if($isModeOpenAccueil)
           @include('livewire.component.accueil')
        @endif
        @if($isModeOpenAvis)
           @include('livewire.component.avis')
        @endif
        @if($isModeOpenCadeau)
            @include('livewire.component.cadeau')
        @endif
        @if($isModeOpenFaq)
          @include('livewire.component.faq')
        @endif
        @if($isModeOpenQsn)
           @include('livewire.component.qsn')
         @endif

       
     
       
    </div>
    <div class="max-w-2xl mx-auto sm:px-8 lg:px-10" >
        {{-- <div class="   bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"> --}}
            <div  class="fixed bottom-0 grid  grid-cols-5 gap-x-2 bg-gray-100  " >
                <div wire:click="accueil()" class="flex flex-col  items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="max-auto fill-current h-7 w-7  mt-1 " viewBox="0 0 20 20" fill="currentColor" >
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    
                    <span  style="font-size: 10px;font-weight: bold" class="tab  block  text-center">EVENEMENT PHYSARO</span>
                </div>
                <div wire:click="avis()" class="flex flex-col   items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7  mt-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                   
                    <span  style="font-size: 10px;font-weight: bold" class="tab tab-kategori block  text-center">AVIS</span>
                </div>
                <div wire:click="cadeau()" class="flex flex-col  items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 " viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                    </svg>
                  
                    <span  style="font-size: 10px;font-weight: bold" class="tab tab-explore block  text-center">CADEAU DE PARRAIN</span>
                </div>
                <div wire:click="faq()" class="flex flex-col  items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 " viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                  
                    <span  style="font-size: 10px;font-weight: bold" class="tab tab-whishlist block text-center">FAQ</span>
                </div>
                <div wire:click="qsn()" class="flex flex-col  items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 " viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                      
                    <span  style="font-size: 10px;font-weight: bold" class="tab tab-account block text-center">QUI NOUS SOMMES</span>
                </div>
            </div>
        {{-- </div> --}}
           
     
    </div>
</div>






{{-- 
<div style="min-width: 37rem;" class="grid mt-8 grid-cols-5 bg-gray-100 shadow  mx-auto  lg:px-0" >
    <div wire:click="accueil()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7  mt-1  ml-10" viewBox="0 0 20 20" fill="currentColor" >
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        
        <span  style="font-size: 10px;font-weight: bold" class="tab  block  text-center">EVENEMENT PHYSARO</span>
    </div>
    <div wire:click="avis()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7  mt-1 ml-11" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
        </svg>
       
        <span  style="font-size: 10px;font-weight: bold" class="tab tab-kategori block  text-center">AVIS</span>
    </div>
    <div wire:click="cadeau()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 ml-11" viewBox="0 0 20 20" fill="currentColor">
            <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
        </svg>
      
        <span  style="font-size: 10px;font-weight: bold" class="tab tab-explore block  text-center">CADEAU DE PARRAIN</span>
    </div>
    <div wire:click="faq()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 ml-11" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
      
        <span  style="font-size: 10px;font-weight: bold" class="tab tab-whishlist block text-center">FAQ</span>
    </div>
    <div wire:click="qsn()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-7 w-7 mt-1 ml-11" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
          
        <span  style="font-size: 10px;font-weight: bold" class="tab tab-account block text-center">QUI NOUS SOMMES</span>
    </div>
</div> --}}

