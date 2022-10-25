<div class="row">
    <div class="col-12">
       <div style="background-color: #2a3f54;color:#fff ; padding : 5px">
           <p style="text-align: center">Somme des depenses</p>
           <p style="text-align: center" id="somme"><b>{{ $sommes }} Franc cfa</b></p>
       </div>
       <br><br>
    </div>
   
   <div class="col-6">
         <div class="form-group">
             <label for="">Date Debut</label>
             <input type="date" wire:model="date_debut" class="form-control">
         </div>
   </div>
   <div class="col-6">
       <div class="form-group">
           <label for="">Date Fin</label>
           <input type="date" wire:model="date_fin" class="form-control">
       </div>
   </div>
  
  
   <div class="col-12">
    <div>
        <h1>{{ $chart1->options['chart_title'] }}</h1>
        {!! $chart1->renderHtml() !!}
    </div>
   </div>
</div>
@push('scripts')
     {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}     
@endpush