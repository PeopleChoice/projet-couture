<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if($this->command->confirm("Voudriez-vous supprimer  les données de la base de donnée ?")){
           $this->command->call('migrate:refresh');
           $this->command->call('Données supprimé');
        }

        $permissions = Permission::defaultPermissions();

        foreach($permissions as $item){
            Permission::firstOrCreate(['name'=>$item]);
        }

        $this->command->info('les permissions par defaut sont ajouté !');

        if($this->command->confirm('Créer le role des utilisateurs ? [y|N]',true)){
            $recup_roles = $this->command->ask('Saisie les rôles séparés par des virgules','Exemple : Admin,Gestionnaire');

            $roles_array = \explode(',', $recup_roles);


            foreach($roles_array as $role){
                //dd($role);
                $role = Role::firstOrCreate(['name'=>trim($role)]);
              
                if($role->name == 'Admin'){
                    $role->syncPermissions(Permission::all());
                    $this->command->info("Le role admin a la totalité de permissions");
                }else{
                    $role->syncPermissions(Permission::where('name','LIKE','afficher_%')->get());
                }
            }
        }else{
            Role::firstOrCreate(['name'=>'Gestionnaire']);
            $roles_array = Role::all();
            foreach($roles_array as $role){
                if($role->name == 'Admin'){
                    $role->syncPermissions(Permission::all());
                    $this->command->info("Le role admin a la totalité de permissions");
                }else{
                    $role->syncPermissions(Permission::all());
                }
            }

        }
    }




}
