<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class RestaurantsController extends Component
{
    public $isModeOpenAccueil = true;
    public $isModeOpenAvis = 0;
    public $isModeOpenCadeau = 0;
    public $isModeOpenFaq = 0;
    public $isModeOpenQsn = 0;
    public $title = "EVENEMENT PHYSARO";
    public $qrcode ;
    public $pay="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5245.799309628837!2d2.3036223!3d48.8982495!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f0acc2d6839%3A0xaba7882f97c78e17!2sLA%20MARINA!5e0!3m2!1sen!2ssn!4v1622794201492!5m2!1sen!2ssn";

    public function mount(){
        $qrcode = QrCode::size(200)->generate("Je suis un QR Code");
    }
    public function render()
    {
        $qrcode = $this->qrcode;
        //dd($qrcode);
        return view('livewire.restaurants',\compact('qrcode'));
    }


    public function accueil(){
      
       $this->title = "EVENEMENT PHYSARO";
       $this->emit('title', $this->title);
       $this->isModeOpenAvis = false;
       $this->isModeOpenCadeau = false;
       $this->isModeOpenFaq = false;
       $this->isModeOpenQsn = false;
       $this->isModeOpenAccueil = true;
    }

    public function avis(){
       $this->title = "AVIS ";
       $this->emit('title', $this->title);
       $this->isModeOpenAccueil = false;
       $this->isModeOpenCadeau = false;
       $this->isModeOpenFaq = false;
       $this->isModeOpenQsn = false;
       $this->isModeOpenAvis = true;
    }

    public function cadeau(){
        $this->title = "CADEAU DE PARRAINAGE";
        $this->emit('title', $this->title);
        $this->isModeOpenAccueil = false;
        $this->isModeOpenAvis = false;
        $this->isModeOpenFaq = false;
        $this->isModeOpenQsn = false;
        $this->isModeOpenCadeau = true;
    }

    public function faq(){
        $this->title = "FAQ";
        $this->emit('title', $this->title);
        $this->isModeOpenAccueil = false;
        $this->isModeOpenAvis = false;
        $this->isModeOpenCadeau = false;
        $this->isModeOpenQsn = false;
        $this->isModeOpenFaq = true;
    }
    public function  qsn(){
        $this->title = "QUI NOUS SOMMES";
        $this->emit('title', $this->title);
        $this->isModeOpenAccueil = false;
        $this->isModeOpenAvis = false;
        $this->isModeOpenCadeau = false;
        $this->isModeOpenFaq = false;
        $this->isModeOpenQsn = true;
      
    }

}
