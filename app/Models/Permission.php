<?php
namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission{

    public static function defaultPermissions() {
        return [
               'afficher_roles',
               'ajouter_roles',
               'modifier_roles',
               'supprimer_roles',

               'afficher_clients',
               'ajouter_clients',
               'modifier_clients',
               'supprimer_clients',

               'afficher_commandes',
               'ajouter_commandes',
               'modifier_commandes',
               'supprimer_commandes',

               'afficher_decouvertes',
               'ajouter_decouvertes',
               'modifier_decouvertes',
               'supprimer_decouvertes',


               'afficher_depenses',
               'ajouter_depenses',
               'modifier_depenses',
               'supprimer_depenses',

               'afficher_prestations',
               'ajouter_prestations',
               'modifier_prestations',
               'supprimer_prestations',


               'afficher_categories',
               'ajouter_categories',
               'modifier_categories',
               'supprimer_categories',

               'afficher_produits',
               'ajouter_produits',
               'modifier_produits',
               'supprimer_produits',

               'afficher_commandeBoutiques',
               'ajouter_commandeBoutiques',
               'modifier_commandeBoutiques',
               'supprimer_commandeBoutiques',

               'afficher_users',
               'ajouter_users',
               'modifier_users',
               'supprimer_users',

               'afficher_boutiques',
               'ajouter_boutiques',
               'modifier_boutiques',
               'supprimer_boutiques',
               
               
        ];
    }
}
