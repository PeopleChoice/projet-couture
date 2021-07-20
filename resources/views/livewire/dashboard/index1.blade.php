@include('livewire.dashboard.dash2')
@push('scripts')
     {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!} 
    {!! $chart2->renderJs() !!} 


    
@endpush
