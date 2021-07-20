@include('livewire.dashboard.dash1')
@push('scripts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
@endpush
