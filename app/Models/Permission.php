<?php
namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission{

    public static function defaultPermissions() {
        return [
               'afficher_roles',
               'ajouter_roles',
               'modifier_roles',
               'supprimer_roles'
        ];
    }
}
