<?php

class SecurityView extends View {

    /**
     * Affichage du formulaire de connexion
     *
     * @return void
     */
    public function addForm()
    {
        // $this->page .= "<h1>Se connecter</h1>";
        $this->page .= file_get_contents('template/formLogin.html');
        $success = "";
        if (isset($_SESSION['flash'])){
            $success = "<div class='form-group alert alert-success text-center'>"
                    . $_SESSION['flash']['success']
                    . "</div>";
        }
        $this->page = str_replace('{success}', $success,$this->page);
        $this->displayPage();
    }

    /**
     * Affichage du formulaire oubli du mot de passe
     *
     * @return void
     */
    public function addForget()
    {
        $this->page .= file_get_contents('template/formForget.html');
        $danger = "";
        if (isset($_SESSION['flash'])){
            $danger = "<div class='form-group alert alert-danger text-center'>"
                    . $_SESSION['flash']['danger']
                    . "</div>";
        }
        $this->page = str_replace('{danger}', $danger,$this->page);
        $this->displayPage();
    }

    public function addReset()
    {
        $this->page .= file_get_contents('template/formReset.html');
        $alert = "";
        if (isset($_SESSION['flash'])){
            $alert = "<div class='form-group alert alert-danger text-center'>"
                    . $_SESSION['flash']['alert']
                    . "</div>";
        }
        $this->page = str_replace('{alert}', $alert,$this->page);
        $this->displayPage();
    }

}
