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
use App\Models\Commande;
class DashBoard extends Component
{
    public $firstRun = true;
    public $sommeDepense = 0;
    public $showDataLabels = false;
    public $allCommande = 0;
    public $allCommandePrix = 0;
    public $allCommandeNonPayerPrix = 0;
    public $allCommandePayerPrix = 0;
    public $allCommandeEnCoursPrix = 0;
    public $allCommandeTerminePrix = 0;
    public $allCommandeTermineNonPayerPrix = 0;
    public $allCommandeNonPayer = 0;
    public $allCommandePayer = 0;
    public $allCommandeEnCours = 0;
    public $allCommandeTermine = 0;
    public $allCommandeTermineNonPayer = 0;
    public $allCommandeEnconfection = 0;
    public $allCommandeEnconfectionPrix = 0;
    public $date_debut = 0;
    public $date_fin = 0;
    public function render()
    {
        $depense = Depense::get();
        $this->allCommande = Commande::count();
        $this->allCommandeNonPayer = Commande::where('payer',0)->count();
        $this->allCommandePayer = Commande::where('payer',1)->count();
        $this->allCommandeEnCours = Commande::where('status',"En cours")->count();
        $this->allCommandeTermine = Commande::where('status',"Termine")->count();
        $this->allCommandeEnconfection = Commande::where('status',"En confection")->count();
        $this->allCommandeTermineNonPayer = Commande::where('payer',0)->where('status',"Termine")->count();

        $allcommande = Commande::with('detaille')->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandePrix = $cpt1;
        $allcommande = Commande::with('detaille')->where('payer',0)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeNonPayerPrix = $cpt1;
        $allcommande = Commande::with('detaille')->where('payer',1)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandePayerPrix = $cpt1;
        $allcommande = Commande::with('detaille')->where('payer',1)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandePayerPrix = $cpt1;

        $allcommande = Commande::with('detaille')->where('status','En cours')->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeEnCoursPrix = $cpt1;


        $allcommande = Commande::with('detaille')->where('status','En confection')->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeEnconfectionPrix = $cpt1;

        $allcommande = Commande::with('detaille')->where('status','Termine')->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeTerminePrix = $cpt1;

        $allcommande = Commande::with('detaille')->where('status','Termine')->where('payer',0)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeTermineNonPayerPrix = $cpt1;
          
        $allDepenses = Depense::get();
       
        $somme = 0;
        foreach($allDepenses as $i ){
            $somme = $somme + ($i->qt * $i->prix);
        }


           
        $this->sommeDepense = $somme;
        
        $chart_options1 = [
            'chart_title' => 'Commandes',
            //'chart_height'=> '150px',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Commande',
            'aggregate_field' => 'id',
            'field_distinct '=> 'id',
            'group_by_field' => 'date_commande',
            'group_by_period' => 'day',
            'filter_field' => 'date_commande',
            'aggregate_function' => 'count',
          //  'filter_days'=> 30,
            //'filter_period' => 'week',
            'chart_type' => 'bar',
        ];
     

        $chart_options2 = [
            'chart_title' => 'Commandes status',
           //'chart_height'=> '150px',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Commande',
            'aggregate_field' => 'id',
            'field_distinct '=> 'id',
            'group_by_field' => 'status',
            'group_by_period' => 'day',

            'filter_field' => 'date_commande',
            'chart_type' => 'pie',
        ];

        // $chart_options2 = [
        //     'chart_title' => 'Mes depenses',
        //    //'chart_height'=> '150px',
        //     'report_type' => 'group_by_string',
        //     'model' => 'App\Models\Depense',
        //     'aggregate_field' => 'id',
        //     'field_distinct '=> 'id',
        //     'group_by_field' => 'date_enreg',
        //     'group_by_period' => 'day',

        //     'filter_field' => 'date_enreg',
        //     'chart_type' => 'pie',
        // ];


        $chart1 = new LaravelChart($chart_options1);
        $chart2 = new LaravelChart($chart_options2);
       
        return view('livewire.dashboard.index',['chart1' => $chart1,'chart2' => $chart2]);
       
    }


}
