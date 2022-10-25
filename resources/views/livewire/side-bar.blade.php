<div>
    <br><br>
    
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('home') }}">Atelier</a></li>
                        <li><a href="{{ route('home1') }}">Boutique</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @can('afficher_roles')
                        <li><a href="{{ route('roles_index') }}">Roles & permissions</a></li>
                        @endcan
                        @can('afficher_users')
                        <li><a href="{{ route('utilisateur') }}">Utilisateurs</a></li>
                        @endcan
                        @can('afficher_decouvertes')
                        <li><a href="{{ route('decouverte') }}">Découverte</a></li>
                        @endcan
                        @can('afficher_depenses')
                        <li><a href="{{ route('depense') }}">Dépenses</a></li>
                        @endcan
                        @can('afficher_prestations')
                        <li><a href="{{ route('prestation') }}">Prestations</a></li>
                        @endcan
                        @can('ajouter_clients')
                        <li><a href="{{ route('clients') }}">Clients & commandes</a></li>
                        @endcan
                        @can('afficher_commandes')
                        <li><a href="{{ route('all_commandes') }}">Commandes</a></li>
                        @endcan
                    </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> Boutique <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @can('afficher_boutiques')
                        <li>
                            <a class="w-full" href="{{ route('boutique') }}">Boutique</a>
                        </li>
                        @endcan
                        @can('afficher_categories')
                        <li>
                            <a class="w-full" href="{{ route('categorie') }}">Catégorie</a>
                        </li>
                        @endcan
                        @can('afficher_produits')
                        <li>
                            <a class="w-full" href="{{ route('produit') }}">Produit</a>
                        </li>
                        @endcan
                        @can('afficher_commandeBoutiques')
                        <li>
                            <a href="{{ route('boutiqueCommande') }}">Mes commandes</a>
    
                        </li>
                        @endcan
    
                    </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Inventaires <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ route('inventaireDepense') }}">Depenses</a>
                        </li>
                        <li>
                            <a href="{{ route('reportingTailleur') }}">Tailleur</a>
                        </li>
                        
                    </ul>
                </li>
               
            </ul>
        </div>
       
    
    </div>
    <!-- /sidebar menu -->
    
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
    </div>
    
     
</div>