<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationMenu extends Component
{   
    public $pageTitle = "Tableau de bord";
    protected $listeners = ['title' => 'recupTitle'];
    public function render()
    {
        return view('livewire.navigation-menu');
    }

    public function recupTitle($title){
         $this->pageTitle = $title;
    }
}
