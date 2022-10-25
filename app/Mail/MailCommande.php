<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCommande extends Mailable
{
    use Queueable, SerializesModels;
   
    private $id_commande;
    private $msg = "content";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_commande)
    {
        
        $this->id_commande = $id_commande;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.index')->with(['msg'=>$this->msg,'id'=>$this->id_commande]);
                    // ->from('mouride987@gmail.com','Commande Client')
                    // ->subject('Commande Client')
                    // ->with([
                    //     'name'=>'DHC',
                    //     'message'=> "test message",
                    //     'link'=> 'localhost:8000/commande/'.$this->id_commande
                    // ]);
    }
}
