<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Commande;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class ReportingTailleur extends Component
{   
    public $sommes = 0;
    public $date_debut ;
    public $date_fin ;
    public $html ;
    public $rendu;
 
  
    public function render()
    {

        $chart_options2 = [
            'chart_title' => 'Status des ventes',
            //'chart_height'=> '150px',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Commande',
            'aggregate_field' => 'id',
            'field_distinct '=> 'id',
            'group_by_field' => 'date_commande'. '00:00:00',
            'group_by_period' => 'day',
            'filter_field' => 'date_commande',
            'chart_type' => 'pie',
        ];

        

        $chart1 = new LaravelChart($chart_options1);
       

        return view('livewire.inventaire.tailleur.index');
              
           
    }



    
    
   
    
    

 


}
