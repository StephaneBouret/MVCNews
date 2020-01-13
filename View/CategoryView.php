<?php

class CategoryView extends View {

    /**
     * Affichage de la page d'accueil
     * Liste des infos
     * Displaying the homepage
     * News list
     *
     * @param [array] $listCategories
     * @return void
     */
    public function displayHome($listCategories)
    {
        // var_dump($listCategories);
        // echo "<h2>Bienvenue</h2>";
        $this->page .= "<h2 class='mt-4 mb-4'>Bienvenue dans la table catégorie</h2>";
        $this->page .= "<p><a href='index.php?controller=category&action=addForm'><button type='button' class='btn btn-primary'>Ajouter</button></a></p>";
        // echo "<p><a href='index.php?action=addForm'><button>Ajouter</button></a></p>";
        $this->page .= "<table class='table'>";
        $this->page .= "<thead class='thead-dark'><tr>";
        $this->page .= "<th scope='col'>Nom</th>";
        $this->page .= "<th scope='col'>Description</th>";
        $this->page .= "<th scope='col' class='text-center'>Modifier</th>";
        $this->page .= "<th scope='col' class='text-center'>Supprimer</th>";
        $this->page .= "</tr></thead><tbody>";
        foreach ($listCategories as $cat) {
            $this->page .= "<tr><th scope='row'>".$cat['name']."</th>"
            ."<td>".$cat['description']."</td>"
            ."<td class='text-center'><a href='index.php?controller=category&action=updateForm&id=".$cat['id']
            ."' class='btn btn-warning ml-auto mr-3'><i class='fas fa-pen'></i></a></td>"
            ."<td class='text-center'><a href='index.php?controller=category&action=suppDB&id="
            .$cat['id']
            ."' class='btn btn-danger'><i class='fas fa-trash'></i></a></td>"
            ."</tr>";
        }
        $this->page .= "</tbody></table>";
        // $this->page .= "<ul class='list-group'>";
        // foreach ($listCategories as $cat) {
        //     $this->page .= "<li class='list-group-item d-flex justify-content-between'>"
        //     ."<h6 class='mt-auto mb-auto'>".$cat['name']."</h6>"
        //     ."<p class='mt-auto mb-auto ml-3'>".$cat['description']."</p>"
        //     ."<a href='index.php?action=updateForm&id="
        //     .$cat['id']
        //     ."' class='btn btn-primary btn btn-primary ml-auto mr-3'><i class='fas fa-pen'></i></a>"
        //     ."<a href='index.php?action=suppDB&id="
        //     .$cat['id']
        //     ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>"
        //     ."</li>";
        //     // echo $cats."<br>";
        // }
        // $this->page .= "</ul>";
        $this->displayPage();
    }

    /**
     * Affichage du formulaire de saisie d'une nouvelle information
     * Displaying the form for entering new information
     *
     * @return void
     */
    public function addForm()
    {
        $this->page .= "<h1>Ajout d'une catégorie</h1>";
        // $this->page .= "J'ajoute une info via un formulaire";
        $this->page .= file_get_contents('template/formCategory.html');
        $this->page = str_replace('{action}','addDB',$this->page);
        $this->page = str_replace('{id}','',$this->page);
        $this->page = str_replace('{name}','',$this->page);
        $this->page = str_replace('{description}','',$this->page);
        // echo "J'ajoute une info via un formulaire";
        // include 'template/form.html';
        $this->displayPage();
    }

    /**
     * Affichage du formulaire contenant l'information à modifier
     * Displaying the form containing the information to be modified
     *
     * @param [type] $cat
     * @return void
     */
    public function updateForm($cat){
        // var_dump($cat);
        $this->page .= "<h1>Modification de la catégorie</h1>";
        $this->page .= file_get_contents('template/formCategory.html');
        $this->page = str_replace('{action}','updateDB',$this->page);
        $this->page = str_replace('{id}',$cat['id'],$this->page);
        $this->page = str_replace('{name}',$cat['name'],$this->page);
        $this->page = str_replace('{description}',$cat['description'],$this->page);
        $this->displayPage();
    }

}
