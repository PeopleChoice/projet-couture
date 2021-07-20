<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use Asantibanez\LivewireCharts\Models\AreaChartModel;
// use Asantibanez\LivewireCharts\Models\ColumnChartModel;
// use Asantibanez\LivewireCharts\Models\LineChartModel;
// use Asantibanez\LivewireCharts\Models\PieChartModel;
// use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
// use ConsoleTVs\Charts\BaseChart;
use App\Models\Depense;
use App\Models\CommandeBoutique;
class DashBoard1 extends Component
{
    public $firstRun = true;

    public $showDataLabels = false;
    public $allCommande = 0;
    public $allCommandePrix = 0;

    public function render()
    {

        $this->allCommande = CommandeBoutique::count();

        $allcommande = CommandeBoutique::with('commandeBoutiqueDetails')->get();
       //dd($allcommande);
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->commandeBoutiqueDetails as $item){
                $cpt2 = $cpt2 + ($item->prix * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - (int)$item->remise);
        }

        $this->allCommandePrix = $cpt1;

    
        $chart_options1 = [
            'chart_title' => 'Mes ventes du jour',
          //  'chart_height'=> '150px',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\CommandeBoutique',
            'aggregate_field' => 'id',
            'field_distinct '=> 'id',
            'group_by_field' => 'date_commande'. '00:00:00',
            'group_by_period' => 'day',
            'filter_field' => 'date_commande',
            'aggregate_function' => 'count',
          //  'filter_days'=> 30,
            //'filter_period' => 'week',
            'chart_type' => 'bar',
        ];

        $chart_options2 = [
            'chart_title' => 'Status des ventes',
            //'chart_height'=> '150px',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\CommandeBoutique',
            'aggregate_field' => 'id',
            'field_distinct '=> 'id',
            'group_by_field' => 'date_commande'. '00:00:00',
            'group_by_period' => 'day',
            'filter_field' => 'date_commande',
            'chart_type' => 'pie',
        ];

        

        $chart1 = new LaravelChart($chart_options1);
        $chart2 = new LaravelChart($chart_options2);
        // ['chart1' => $chart1,'chart2' => $chart2]
       
        return view('livewire.dashboard.index1',['chart1' => $chart1,'chart2' => $chart2]);
       
    }
}
