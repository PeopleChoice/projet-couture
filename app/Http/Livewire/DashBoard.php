<?php

namespace App\Http\Livewire;

use Livewire\Component;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use App\Models\Depense;
use App\Models\Commande;
use DateTime;
class DashBoard extends Component
{
 

    public $listeSemaine = array();
    public $allCommande = array();
    public $allCommandePrix;
    public $allCommandeNonPayerPrix;
    public $allCommandeEnCoursPrix;
    public $allCommandeEnconfectionPrix;
    public $allCommandeTerminePrix;
    public $allCommandeTermineNonPayerPrix;
    public $isOpen = 0;
    public $status;
    public function render(){
        $date = new DateTime(now());
        $week = (int) $date->format("W");
        $tmp1 = array();
        $limit = $week+7;
        $debut = $week-4;
        for($i = $debut;$i <= $limit;$i++){
            array_push($tmp1,$i);
        }
        
        $tmp = array();
        foreach($tmp1 as $i){
            $date = $this->getStartAndEndDate($i);
            $cpt_compteur = 0;
            $cpt_reste = 0;
            $cpt_termine = 0;
            $cpt_livre = 0;
            $cpt_compteur = count(Commande::whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->get());
            $cpt1 = count(Commande::whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->where('status','Termine')->get());
            $cpt2 = count(Commande::whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->where('status','Livre')->get());
            $cpt_termine = $cpt1 + $cpt2;
            $cpt_reste = $cpt_compteur - $cpt_termine;
            $cpt_livre = $cpt2;
            if( $cpt_compteur == 0){
                $cpt_reste = 0;
                $cpt_termine = 0;
                $cpt_livre = 0;
            }
            $color = $this->getColor($cpt_compteur);
            array_push($tmp,["numS"=>$i,"week_start"=>$date['week_start'],
                                           "week_end"=>$date['week_end'],
                                           "nbr_commande"=>$cpt_compteur,
                                           "termine"=>$cpt_termine,
                                           "restant"=>$cpt_reste,
                                           "livre"=>$cpt_livre,
                                           "color"=> $color,
                                           
                                        ]);
        }

        $this->listeSemaine = $tmp;


        $date = new DateTime(now());
        $week = (int) $date->format("W");
        $date = $this->getStartAndEndDate($week);
        $allcommande = Commande::whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->with('detaille')->get();
       
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandePrix = $cpt1;
        $allcommande = Commande::with('detaille')->whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->where('payer',0)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeNonPayerPrix = $cpt1;
        $allcommande = Commande::with('detaille')->whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->where('payer',1)->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandePayerPrix = $cpt1;
        
       
       

       
        $allcommande = Commande::with('detaille')->whereBetween('date_livraison',[$date['week_start'],$date['week_end']])->where('status','En confection')->get();
        $cpt1 = 0;
        foreach($allcommande as $item){
            $cpt2 = 0;
            foreach($item->detaille as $item){
                $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
            }

            $cpt1 = $cpt1 + ($cpt2 - $item->remise);
        }
        $this->allCommandeEnconfectionPrix = $cpt1;
       

         

        return view('livewire.dashboard.index',['listeSemaine'=>$this->listeSemaine,"week_now"=> $week]);
    }

    public function alertCommande($s){
        $this->emit("showModalcommande");
        $date = $this->getStartAndEndDate((int)$s);
        $this->allCommande = Commande::whereBetween('date_livraison',[$date["week_start"],$date["week_end"]])->with("detaille")->with("acompte_commande")->with('client')->orderByDesc('date_commande')->get();
        $this->isOpen = true;
        
    }

    public function changeStatus($id){
        if($this->status){
            Commande::where('id',$id)->update(["status"=>$this->status]);
            session()->flash('message', 'Changement effectué');
        }else{
            session()->flash('error', 'Merci de verifier la selection');
        }
        $this->emit("hideModalcommande");
    }

    function getColor($num){
        $color_red = "#F15131";
        $color_green = "#1abb9c";
        $color_yellow = "#EADB1E";
        $color="";
        if($num >= 0 && $num <5){
            $color = $color_green;
        }
        if($num >= 5 && $num <8){
            $color = $color_yellow;
        }

        if($num >= 8){
            $color = $color_red;
        }
        

        return $color;
    }

    function getStartAndEndDate($week) {
        $dto = new DateTime();
        $dto->setISODate(date("Y"), $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
      }
    // public function render()
    // {
    //     $depense = Depense::get();
    //     $this->allCommande = Commande::count();
    //     $this->allCommandeNonPayer = Commande::where('payer',0)->count();
    //     $this->allCommandePayer = Commande::where('payer',1)->count();
    //     $this->allCommandeEnCours = Commande::where('status',"En cours")->count();
    //     $this->allCommandeTermine = Commande::where('status',"Termine")->count();
    //     $this->allCommandeEnconfection = Commande::where('status',"En confection")->count();
    //     $this->allCommandeTermineNonPayer = Commande::where('payer',0)->where('status',"Termine")->count();

    //     $allcommande = Commande::with('detaille')->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandePrix = $cpt1;
    //     $allcommande = Commande::with('detaille')->where('payer',0)->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandeNonPayerPrix = $cpt1;
    //     $allcommande = Commande::with('detaille')->where('payer',1)->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandePayerPrix = $cpt1;
    //     $allcommande = Commande::with('detaille')->where('payer',1)->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandePayerPrix = $cpt1;

    //     $allcommande = Commande::with('detaille')->where('status','En cours')->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandeEnCoursPrix = $cpt1;


    //     $allcommande = Commande::with('detaille')->where('status','En confection')->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandeEnconfectionPrix = $cpt1;

    //     $allcommande = Commande::with('detaille')->where('status','Termine')->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandeTerminePrix = $cpt1;

    //     $allcommande = Commande::with('detaille')->where('status','Termine')->where('payer',0)->get();
    //     $cpt1 = 0;
    //     foreach($allcommande as $item){
    //         $cpt2 = 0;
    //         foreach($item->detaille as $item){
    //             $cpt2 = $cpt2 + ($item->prix_u * $item->qt);
    //         }

    //         $cpt1 = $cpt1 + ($cpt2 - $item->remise);
    //     }
    //     $this->allCommandeTermineNonPayerPrix = $cpt1;
          
    //     $allDepenses = Depense::get();
       
    //     $somme = 0;
    //     foreach($allDepenses as $i ){
    //         $somme = $somme + ($i->qt * $i->prix);
    //     }


           
    //     $this->sommeDepense = $somme;
        
    //     $chart_options1 = [
    //         'chart_title' => 'Commandes',
    //         //'chart_height'=> '150px',
    //         'report_type' => 'group_by_date',
    //         'model' => 'App\Models\Commande',
    //         'aggregate_field' => 'id',
    //         'field_distinct '=> 'id',
    //         'group_by_field' => 'date_commande',
    //         'group_by_period' => 'day',
    //         'filter_field' => 'date_commande',
    //         'aggregate_function' => 'count',
    //       //  'filter_days'=> 30,
    //         //'filter_period' => 'week',
    //         'chart_type' => 'bar',
    //     ];
     

    //     $chart_options2 = [
    //         'chart_title' => 'Commandes status',
    //        //'chart_height'=> '150px',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\Commande',
    //         'aggregate_field' => 'id',
    //         'field_distinct '=> 'id',
    //         'group_by_field' => 'status',
    //         'group_by_period' => 'day',

    //         'filter_field' => 'date_commande',
    //         'chart_type' => 'pie',
    //     ];

      


    //     $chart1 = new LaravelChart($chart_options1);
    //     $chart2 = new LaravelChart($chart_options2);
       
    //     return view('livewire.dashboard.index',['chart1' => $chart1,'chart2' => $chart2]);
       
    // }


}
