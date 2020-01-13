<?php

include "Model/UserModel.php";
include "View/UserView.php";

class UserController extends Controller {

    public function __construct()
    {
        $this->view = new UserView();
        $this->model = new UserModel();
    }

    /**
     * Construction de la page d'accueil
     * Building the homepage
     *
     * @return void
     */
    public function start(){
        // $model = new Model();
        $listUsers = $this->model->getUsers();
        // var_dump($listUsers);

        // $view = new View();
        // $view->displayHome($listUsers);
        $this->view->displayHome($listUsers);
    }

    /**
     * Gestion de l'ajout d'un item
     * Management of adding an item
     *
     * @return void
     */
    public function addDB()
    {
        $this->model->addDB();
        // $this->start();
        header('location:index.php?controller=User');
    }

    /**
     * Gestion de la supression d'un item
     * Management of item deletion
     *
     * @return void
     */
    public function suppDB(){
        $this->model->suppDB();
        header('location:index.php?controller=User');
    }
    /**
     * Gestion de la modification d'un item
     * Managing the change of an item
     *
     * @return void
     */
    public function updateForm(){
        $user = $this->model->getUser();
        $this->view->updateForm($user);
    }

    /**
     * Mise à jour de l'information dans la table
     * Updating information in the table
     *
     * @return void
     */
    public function updateDB(){
        $this->model->updateDB();
        header('location:index.php?controller=User');
    }
}