<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
class RoleController extends Component
{   public $title ="Roles & permission";
    public $openModal = 0;
    public $name;
    public $id_role;
    public $permission = [];
    public $allpermissions = [];
  
  
    
    public function render()
    {
      
        $this->emit('title', $this->title);
        $roles = Role::all();
        $permissions = Permission::all();
        $this->allpermissions = $permissions;
        return view('livewire.component.role.role_index', compact('roles', 'permissions'));
    
    }

    public function create(){
        $this->openModal = true;
    }


    public function store()
    {
        $this->validate(['name' => 'required|unique:roles']);
       
        if( Role::create(['name'=>$this->name]) ) {
            $this->openModal = false;
            $this->name = "";
        }

        return redirect()->back();
    }

    public function closeModalPopover(){
        $this->openModal = false;
    }


    public function update($id)
    {
       
        //dd($id);
      
        if($role = Role::findOrFail($id)) {
            
           
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
            }

            // dd($this->permission);

            $role->syncPermissions($this->permission);

            
        } 
        $this->permission = [];
        session()->flash('message', 'permission modifié');

    }


    public function checkClick($id,$roleid){
      
            $role = Role::findOrFail($roleid);
            $ancienne_permission = array();
            foreach($this->allpermissions as $perm){
                $per_found = null;

                if( isset($role) ) {
                    $per_found = $role->hasPermissionTo($perm->name);
                }

                
                
                if($per_found == true)
                {
                    array_push($ancienne_permission,$perm->id);
                }


            }

           // dd($ancienne_permission);
            foreach($ancienne_permission as $item)
            {
                //dd($item);
                if(!in_array($item, $this->permission))
                {
                    array_push($this->permission,$item);
                }   
                
            }
       
           //dd($this->permission);
        if(!in_array($id, $this->permission)){
            \array_push($this->permission,$id);
        }else{
            //dd($id);

            unset($this->permission[($id-1)]);
        }
        //dd($this->permission);
    }
}
