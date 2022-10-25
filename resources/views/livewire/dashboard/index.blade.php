{{-- @include('livewire.dashboard.dash1') --}}
{{-- @push('scripts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
@endpush --}}

<div class="row" style="animation:3s ;">
    
      <div class="col-12">
           <div>
            
               @include("livewire.dashboard.commande_modal");
         
           </div>
         
      </div>
      <div class="col-12">
        <div class="row">
            <div class="col-md-3 col-sm-3  tile">
                <span>Total</span>
                <h2><b>{{ $allCommandePrix }} f cfa</b></h2>
            </div>
            <div class="col-md-3 col-sm-3  tile">
                <span>Total Non Payé</span>
                <h2><b>{{ $allCommandeNonPayerPrix }} f cfa</b></h2>
            </div>
            <div class="col-md-3 col-sm-3  tile">
                <span>Total Payé</span>
                <h2><b>{{ $allCommandePayerPrix }} f cfa</b></h2>
            </div>
            <div class="col-md-3 col-sm-3  tile">
                <span>Total En Confection</span>
                <h2><b>{{ $allCommandeEnconfectionPrix }} f cfa</b></h2>
            </div>
        </div>
      </div>
      <br><br>
      @foreach ($listeSemaine as $item)
        @if ($item['numS'] == $week_now)
        <div  class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" wire:click="alertCommande({{$item["numS"]}})">

            
            <div class="right" style="height:180px;border-left: 1px solid #ADB2B5;border-bottom: 1px solid #ADB2B5; border-right: 1px solid #ADB2B5;margin-top: 0px; margin-left: 10px; padding-left: 0px;margin-bottom: 5px;">
        
                <div style="background-color: #2a3f54; color:white;text-align:center;">
                <span class="count_top"><i class="fa fa-calendar"><b style="font-size: 18px;"></b></i> </span>
                </div>
                <div class="count">
                    <button id="numSemaine" name="numSemaine" type="submit" value="22,20022" style="background-color:white; color:#7cc404; border:none;">
                        <small class="h3" style="color:#545454">S</small><small class="h1" style="color:{{ $item['color'] }}">{{ $item["numS"] }}</small>
                    </button>
                    <span class="count_top pull-right" style="font-size: 20px; color:#545454; padding-right: 5px;">{{ $item['nbr_commande'] }}</span> 
                </div>
                <p class="count_bottom" style="text-align: center;font-size: 15px; "> Du <b> {{ $item["week_start"] }}</b>  au  <b>{{ $item["week_end"] }}</b></p> <br> 
                
                <div>
                    <span style="padding-left: 5px;">Restant| <small style="font-size: 15px;color:#545454">{{ $item['restant'] }}</small></span> <br>
                    <span  style="padding-left: 5px;">Términé | <small style="font-size: 15px;color:#545454">{{ $item['termine'] }}</small></span> <br>
                    <span  style="padding-left: 5px;">Livré | <small style="font-size: 15px;color:#545454">{{ $item['livre'] }}</small></span> <br>
                </div>
                
            
            </div>
            
    </div>
        @else
        <div  class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" wire:click="alertCommande({{$item["numS"]}})">

            
            <div class="right" style="height:180px;border-left: 1px solid #ADB2B5;border-bottom: 1px solid #ADB2B5; border-right: 1px solid #ADB2B5;margin-top: 0px; margin-left: 10px; padding-left: 0px;margin-bottom: 6px;">
        
                <div style="background-color: #1abb9c; color:white;text-align:center;">
                <span class="count_top"><i class="fa fa-calendar"><b style="font-size: 18px;"></b></i> </span>
                </div>
                <div class="count">
                    <button id="numSemaine" name="numSemaine" type="submit" value="22,20022" style="background-color:white; color:#7cc404; border:none;">
                        <small class="h3" style="color:#545454">S</small><small class="h1" style="color:{{ $item['color'] }}">{{ $item["numS"] }}</small>
                    </button>
                    <span class="count_top pull-right" style="font-size: 20px; color: #545454; padding-right: 5px;">{{ $item['nbr_commande'] }}</span> 
                </div>
                <p class="count_bottom" style="text-align: center;font-size: 15px; "> Du <b> {{ $item["week_start"] }}</b>  au  <b>{{ $item["week_end"] }}</b></p> <br> 
                
            <div >
                <span style="padding-left: 5px;">Restant | <small style="font-size: 15px;color:#545454">{{ $item['restant'] }}</small></span> <br>
                <span  style="padding-left: 5px;">Términé | <small style="font-size: 15px;color:#545454">{{ $item['termine'] }}</small></span> <br>
                <span  style="padding-left: 5px;">Livré | <small style="font-size: 15px;color:#545454">{{ $item['livre'] }}</small></span> <br>
            </div>
                
            
            </div>
            
    </div>
        @endif
     
  
      @endforeach
</div>

@push('scripts')
    
            Livewire.on('showModalcommande',()=>{
                $("#modalcommandeC").modal('show');
               
            });

            Livewire.on('hideModalcommande',()=>{
                $("#modalcommandeC").modal('hide');
            });
   
@endpush