<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
class UserController extends Component
{   public $title ="Utilisateurs";
    public $isModalOpen = 0;
    public $searchTerms;
    public $roles;
    public $name,$email,$password,$role,$user_id;

    use WithPagination;
    
    public function render()
    {
         $searchTerms = "%".$this->searchTerms."%";
         $this->emit('title', $this->title);
       
       
        return view('livewire.users.user-controller',['users'=>User::where('name','like',$searchTerms)
                                                                                ->orWhere('email','like',$searchTerms)
                                                                                ->paginate(10)]);
    
    }


    public function create(){
        $this->roles = Role::all();
        $this->isModalOpen = true;

    }


    public function save(){
        $this->validate(['name' => 'required','email'=>'required']);

        $user = User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'password' =>Hash::make($this->password),
        ]);
        if($this->role){
            $user->assignRole($this->role);
        }
      
        $this->isModalOpen = false;
        $this->name = "";
        $this->email = "";

        session()->flash('message', 'Utilisateur ajouté');
    }


   public function close(){
    $this->isModalOpen = false;
   }



   public function edit($id){
      $this->roles = Role::all();
       $this->isModalOpen = true;
       $this->user_id = $id;
       $user = User::findOrFail($id);
       $this->name = $user->name;
       $this->email = $user->email;

   }

   
   public function delete($id){
    User::find($id)->delete();
    session()->flash('message', 'Utilisateur  supprimé.');
   }


}