<div class="fixed max-h-full z-10 inset-0 overflow-y-auto ease-out duration-400 " wire:click="closeModalImage()">
    <div class="flex items-end justify-center max-h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
          
                
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden" style="height: 700px"  ><br>
                <div class="flex items-end justify-end w-full bg-cover " style="height: 700px;background-image: url({{asset('storage/images/'.$imageRecup)}})">
                   
                </div>
               
            </div>
                
          
        </div>
    </div>
</div>
