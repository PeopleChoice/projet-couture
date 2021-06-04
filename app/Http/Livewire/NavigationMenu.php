<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationMenu extends Component
{   
    public $title = "EVENEMENT PHYSARO";
    protected $listeners = ['title' => 'recupTitle'];
    public function render()
    {
        return view('livewire.navigation-menu');
    }

    public function recupTitle($title){
         $this->title = $title;
    }
}
