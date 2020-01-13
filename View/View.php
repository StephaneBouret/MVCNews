<?php

abstract class View {

    protected $page;

    /**
     * Ajout de l'entête de la page
     * Adding the page header
     */
    public function __construct()
    {
        // include 'template/head.html';
        $this->page = file_get_contents('template/head.html');
        $this->page .= file_get_contents('template/nav.html');

        if(isset($_SESSION['user'])) {
            $optionConnect = "<a class='nav-link' href='index.php?controller=security&action=logout'>Se déconnecter</a>";
            $optionCat = "<a class='nav-link {activeCat}' href='index.php?controller=category'>Categories</a>";
            $optionUser = "<a class='nav-link {activeUser}' href='index.php?controller=user'>Utilisateur</a>";
        } else {
            $optionConnect = "<a class='nav-link' href='index.php?controller=security&action=formLogin'>Se connecter</a>";
            $optionCat = "";
            $optionUser = "";
        }
        $this->page = str_replace('{optionConnect}', $optionConnect,$this->page);
        $this->page = str_replace('{listCat}', $optionCat,$this->page);
        $this->page = str_replace('{listUser}', $optionUser,$this->page);

        if(!isset($_GET['controller'])){
            $_GET['controller'] = "new";
        }
        // if ($_GET['controller'] == "") {
        //     $this->page = str_replace('{activeNew}','active',$this->page);
        // }
        if ($_GET['controller'] == "new") {
            $this->page = str_replace('{activeNew}','active',$this->page);
            $this->page = str_replace('{title}','Actualités',$this->page);
        }
        if ($_GET['controller'] == "category"){
            $this->page = str_replace('{activeCat}','active',$this->page);
            $this->page = str_replace('{title}','Catégories',$this->page);
        }
        if ($_GET['controller'] == "user"){
            $this->page = str_replace('{activeUser}','active',$this->page);
            $this->page = str_replace('{title}','Utilisateurs',$this->page);
        }
    }

    /**
     * Affichage de l'attribut page
     * Display page attribute
     *
     * @return void
     */
    protected function displayPage()
    {
        $this->page .= file_get_contents('template/footer.html');
        // include 'template/footer.html';
        echo $this->page;
    }

}
