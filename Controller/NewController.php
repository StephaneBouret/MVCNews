<?php

include "Model/NewModel.php";
include "View/NewView.php";

class NewController extends Controller {

    public function __construct()
    {
        $this->view = new NewView();
        $this->model = new NewModel();
    }

    /**
     * Construction de la page d'accueil
     * Building the homepage
     *
     * @return void
     */
    public function start(){
        // $model = new Model();
        $listNews = $this->model->getNews();
        // var_dump($listNews);

        // $view = new View();
        // $view->displayHome($listNews);
        $this->view->displayHome($listNews);
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
        header('location:index.php?controller=new');
    }

    /**
     * Gestion de la supression d'un item
     * Management of item deletion
     *
     * @return void
     */
    public function suppDB(){
        $this->model->suppDB();
        header('location:index.php?controller=new');
    }
    /**
     * Gestion de la modification d'un item
     * Managing the change of an item
     *
     * @return void
     */
    public function updateForm(){
        $listCategories = $this->model->getCategories();
        $new = $this->model->getNew();
        $this->view->updateForm($new, $listCategories);
    }

        /**
     * Gestion de l'affichage du formulaire d'ajout
     * Manage the display of the add form
     *
     * @return void
     */
    public function addForm()
    {
        // $view = new View();
        // $view->displayForm();
        // $listCategories = ['info1','info2','info3'];
        $listCategories = $this->model->getCategories();
        $this->view->addForm($listCategories);
    }

    /**
     * Mise à jour de l'information dans la table
     * Updating information in the table
     *
     * @return void
     */
    public function updateDB(){
        $this->model->updateDB();
        header('location:index.php?controller=new');
    }

        /**
     * Affichage de la page Modal de la News
     *
     * @return void
     */
    public function modal(){
        $new = $this->model->getNew();
        $this->view->modal($new);
    }
}