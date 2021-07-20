<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gaps-4 justify-center">
                <div>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">

                        <div class="p-3 rounded-full bg-indigo-600 text-white bg-opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="mx-5">
                            <div class="text-sm text-gray-500" style="text-align: center">Ventes</div>
                            <h4 class="text-sm font-semibold text-gray-700" style="text-align: center">
                                {{ $allCommande }}</h4>
                        </div>
                    </div>
                </div>
                {{-- fin --}}
                <div>
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 text-white bg-opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="mx-5">
                            <div class="text-sm text-red-500" style="text-align: center">Somme Totale</div>
                            <h4 class="text-sm font-semibold text-gray-700" style="text-align: center">
                               {{ $allCommandePrix }} Fcfa</h4>
                        </div>
                    </div>
                </div>
              
            </div>
            <br>
           
         
            {{-- <livewire:livewire-column-chart :column-chart-model="$columnChartModel" /> --}}
        </div>
      
    </div>
    
</div>
<div class="grid grid-cols-1 md:grid-cols-2" >
    <div >
        <h1>{{ $chart1->options['chart_title'] }}</h1>
        {!! $chart1->renderHtml() !!}
    </div>
    <div >
        <h1>{{ $chart2->options['chart_title'] }}</h1>
        {!! $chart2->renderHtml() !!}
    </div>
</div>
