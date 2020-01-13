<?php

class NewView extends View {

     /**
     * Affichage de la page d'accueil
     * Liste des infos
     * Displaying the homepage
     * News list
     *
     * @param [array] $listNews
     * @return void
     */
    // public function displayHome($listNews)
    // {
    //     // var_dump($listNews);
    //     // echo "<h2>Bienvenue</h2>";
    //     $this->page .= "<h2 class='mt-4 mb-4'>Bienvenue dans la table News</h2>";
    //     $this->page .= "<p><a href='index.php?controller=new&action=addForm'><button type='button' class='btn btn-primary'>Ajouter</button></a></p>";
    //     // echo "<p><a href='index.php?action=addForm'><button>Ajouter</button></a></p>";
    //     $this->page .= "<ul class='list-group'>";
    //     foreach ($listNews as $new) {
    //         $this->page .= "<li class='list-group-item d-flex justify-content-between'>"
    //         ."<h6 class='mt-auto mb-auto'>".$new['titre']."</h6>"
    //         ."<p class='mt-auto mb-auto ml-3'>".$new['description']."</p>"
    //         ."<p class='mt-auto mb-auto ml-3'>".$new['name_category']."</p>"
    //         ."<a href='index.php?controller=new&action=updateForm&id="
    //         .$new['id']
    //         ."' class='btn btn-primary btn btn-primary ml-auto mr-3'><i class='fas fa-pen'></i></a>"
    //         ."<a href='index.php?controller=new&action=suppDB&id="
    //         .$new['id']
    //         ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>"
    //         ."</li>";
    //         // echo $news."<br>";
    //     }
    //     $this->page .= "</ul>";
    //     $this->displayPage();
    // }
    public function displayHome($listNews)
    {
        $this->page .= "<h2 class='mt-4 mb-4'>Bienvenue dans la table News</h2>";
        if(isset($_SESSION['user'])){
            $this->page .= "<p><a href='index.php?controller=new&action=addForm'><button type='button' class='btn btn-primary'>Ajouter</button></a></p>";
        }
        $this->page .= "<table class='table'>";
        $this->page .= "<thead class='thead-dark'><tr>";
        $this->page .= "<th scope='col'>Nom</th>";
        $this->page .= "<th scope='col'>Description</th>";
        $this->page .= "<th scope='col' class='text-center'>Catégorie</th>";
        $this->page .= "<th scope='col' class='text-center'>Lire</th>";
        if(isset($_SESSION['user'])){
            $this->page .= "<th scope='col' class='text-center'>Modifier</th>";
            $this->page .= "<th scope='col' class='text-center'>Supprimer</th>";
        }
        $this->page .= "</tr></thead><tbody>";
        foreach ($listNews as $new) {
            $this->page .= "<tr><th scope='row'>".$new['titre']."</th>"
            ."<td>".mb_strimwidth($new['description'], 0, 60, '[...]')."</td>"
            ."<td class='text-center'>".$new['name_category']."</td>";
            $this->page .= "<td class='text-center'><a href='index.php?controller=new&action=modal&id=".$new['id']
            ."' class='btn btn-success ml-auto mr-auto'><i class='fas fa-eye'></i></a></td>";
            if (isset($_SESSION['user'])) {
                $this->page .= "<td class='text-center'><a href='index.php?controller=new&action=updateForm&id=".$new['id']
                ."' class='btn btn-warning ml-auto mr-auto'><i class='fas fa-pen'></i></a></td>";
                $this->page .= "<td class='text-center'><a href='index.php?controller=new&action=suppDB&id="
                .$new['id']
                ."' class='btn btn-danger ml-auto mr-auto'><i class='fas fa-trash'></i></a></td>";
            }
            $this->page .= "</tr>";
        }
        $this->page .= "</tbody></table>";
        $this->displayPage();
    }

    /**
     * Affichage du formulaire de saisie d'une nouvelle information
     * Displaying the form for entering new information
     *
     * @return void
     */
    public function addForm($listCategories)
    {
        $this->page .= "<h1>Ajout d'une information</h1>";
        $this->page .= file_get_contents('template/formNew.html');
        $this->page = str_replace('{action}','addDB',$this->page);
        $this->page = str_replace('{id}','',$this->page);
        $this->page = str_replace('{titre}','',$this->page);
        $this->page = str_replace('{description}','',$this->page);
        $this->page = str_replace('{photo}','',$this->page);
        $categories = "";
        foreach ($listCategories as $category) {
            $categories .= "<option value='" . $category['id'] . "'>" . $category['name'] ."</option>";
        }
        $this->page = str_replace('{categories}', $categories,$this->page);
        // echo "J'ajoute une info via un formulaire";
        // include 'template/form.html';
        $this->displayPage();
    }

    /**
     * Affichage du formulaire contenant l'information à modifier
     * Displaying the form containing the information to be modified
     *
     * @param [type] $new
     * @return void
     */
    public function updateForm($new, $listCategories){
        // var_dump($new);
        $this->page .= "<h1>Modification de l'information</h1>";
        $this->page .= file_get_contents('template/formNew.html');
        $this->page = str_replace('{action}','updateDB',$this->page);
        $this->page = str_replace('{id}',$new['id'],$this->page);
        $this->page = str_replace('{titre}',$new['titre'],$this->page);
        $this->page = str_replace('{description}',$new['description'],$this->page);
        $this->page = str_replace('{photo}',$new['photo'],$this->page);
        $categories = "";
        foreach ($listCategories as $category) {
            $selected = "";
            if ($new['category'] == $category['id']){
                $selected = "selected";
            }
            $categories .= "<option $selected value='" . $category['id'] . "'>" . $category['name'] ."</option>";
        }
        $this->page = str_replace('{categories}', $categories,$this->page);
        $this->displayPage();
    }

    public function modal($new){
        $this->page .= file_get_contents('template/modal.html');
        $this->page = str_replace('{photo}',$new['photo'],$this->page);
        $this->page = str_replace('{titre}',$new['titre'],$this->page);
        $this->page = str_replace('{description}',nl2br($new['description']),$this->page);  
        $this->displayPage();
    }

}
