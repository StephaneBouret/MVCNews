<?php

include "Model/SecurityModel.php";
include "View/SecurityView.php";

class SecurityController extends Controller {

    public function __construct()
    {
        $this->view = new SecurityView();
        $this->model = new SecurityModel();
    }

    /**
     * Afficher le formulaire de Login
     * Building the homepage
     *
     * @return void
     */
    public function formLogin(){
        $this->view->addForm();
    }

    /**
     * Vérification du login
     *
     * @return void
     */
    public function login()
    {
        $user = $this->model->testlogin();
        if ($user != false){
            header('location:index.php?controller=new');
        } else {
            header('location:index.php?controller=security&action=formLogin');
        }
        
    }

    /**
     * Suppression de la connexion
     *
     * @return void
     */
    public function logout()
    {
        $this->model->logout();
        header('location:index.php?controller=new');
    }

    /**
     * Afficher le formulaire oubli du mot de passe
     *
     * @return void
     */
    public function formForget()
    {
        $this->view->addForget();
    }

    /**
     * Vérification de l'email suite oubli mot de passe
     *
     * @return void
     */
    public function forget()
    {
        $userForget = $this->model->testForget();
        if ($userForget){
            header('location:index.php?controller=security&action=formReset');
        } else {
            header('location:index.php?controller=security&action=formForget');
        }
        
    }

    /**
     * Afficher le formulaire pour réinitialiser le mot de passe
     *
     * @return void
     */
    public function formReset()
    {
        $this->view->addReset();
    }

    /**
     * Fonction pour réinitialiser le mot de passe
     *
     * @return void
     */
    public function reset()
    {
        $userReset = $this->model->resetPW();
        if ($userReset){
            header('location:index.php?controller=security&action=formLogin');
        } else {
            header('location:index.php?controller=security&action=formReset');
        }

    }

}