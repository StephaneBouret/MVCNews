<?php

include "Model/CategoryModel.php";
include "View/CategoryView.php";

class CategoryController extends Controller {


    public function __construct()
    {
        $this->view = new CategoryView();
        $this->model = new CategoryModel();
    }

    /**
     * Construction de la page d'accueil
     * Building the homepage
     *
     * @return void
     */
    public function start(){
        // $model = new Model();
        $listCategories = $this->model->getCategories();
        // var_dump($listNews);

        // $view = new View();
        // $view->displayHome($listNews);
        $this->view->displayHome($listCategories);
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
        header('location:index.php?controller=category');
    }

    /**
     * Gestion de la supression d'un item
     * Management of item deletion
     *
     * @return void
     */
    public function suppDB(){
        $this->model->suppDB();
        header('location:index.php?controller=category');
    }
    /**
     * Gestion de la modification d'un item
     * Managing the change of an item
     *
     * @return void
     */
    public function updateForm(){
        $cat = $this->model->getCategory();
        $this->view->updateForm($cat);
    }

    /**
     * Mise à jour de l'information dans la table
     * Updating information in the table
     *
     * @return void
     */
    public function updateDB(){
        $this->model->updateDB();
        header('location:index.php?controller=category');
    }
}