<?php

class UserView extends View {

    /**
     * Affichage de la page d'accueil
     * Liste des infos
     * Displaying the homepage
     * News list
     *
     * @param [array] $listCategories
     * @return void
     */
    public function displayHome($listUsers)
    {
        // var_dump($listCategories);
        // echo "<h2>Bienvenue</h2>";
        $this->page .= "<h2 class='mt-4 mb-4'>Liste des utilisateurs</h2>";
        $this->page .= "<p><a href='index.php?controller=User&action=addForm'><button type='button' class='btn btn-primary'>Ajouter</button></a></p>";
        // echo "<p><a href='index.php?action=addForm'><button>Ajouter</button></a></p>";
        $this->page .= "<table class='table'>";
        $this->page .= "<thead class='thead-dark'><tr>";
        $this->page .= "<th scope='col'>id</th>";
        $this->page .= "<th scope='col'>Username</th>";
        $this->page .= "<th scope='col'>Prénom</th>";
        $this->page .= "<th scope='col'>Nom</th>";
        $this->page .= "<th scope='col'>Email</th>";
        $this->page .= "<th scope='col' class='text-center'>Modifier</th>";
        $this->page .= "<th scope='col' class='text-center'>Supprimer</th>";
        $this->page .= "</tr></thead><tbody>";
        foreach ($listUsers as $use) {
            $this->page .= "<tr><th scope='row'>".$use['id']."</th>"
            ."<td>".$use['username']."</td>"
            ."<td>".$use['firstname']."</td>"
            ."<td>".$use['lastname']."</td>"
            ."<td>".$use['email']."</td>"
            ."<td class='text-center'><a href='index.php?controller=User&action=updateForm&id=".$use['id']
            ."' class='btn btn-primary btn btn-warning ml-auto mr-3'><i class='fas fa-pen'></i></a></td>"
            ."<td class='text-center'><a href='index.php?controller=User&action=suppDB&id="
            .$use['id']
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
        $this->page .= "<h1>Ajout d'un utilisateur</h1>";
        $this->page .= file_get_contents('template/formUser.html');
        $this->page = str_replace('{action}','addDB',$this->page);
        $this->page = str_replace('{id}','',$this->page);
        $this->page = str_replace('{username}','',$this->page);
        $this->page = str_replace('{password}','',$this->page);
        $this->page = str_replace('{messagePwd}','',$this->page); /** Dans le cadre du mot de passe haché */
        $this->page = str_replace('{lastname}','',$this->page);
        $this->page = str_replace('{firstname}','',$this->page);
        $this->page = str_replace('{email}','',$this->page);
        $this->displayPage();
    }

    /**
     * Affichage du formulaire contenant l'information à modifier
     * Displaying the form containing the information to be modified
     *
     * @param [type] $cat
     * @return void
     */
    public function updateForm($user){
        $this->page .= "<h1>Modification d'un utilisateur</h1>";
        $this->page .= file_get_contents('template/formUser.html');
        $this->page = str_replace('{action}','updateDB',$this->page);
        $this->page = str_replace('{id}',$user['id'],$this->page);
        $this->page = str_replace('{username}',$user['username'],$this->page);
        // $this->page = str_replace('{password}',$user['password'],$this->page); hors cadre mot de passe haché
        $this->page = str_replace('{password}','',$this->page);
        $this->page = str_replace('{messagePwd}','Changer de mot de passe',$this->page); /** Dans le cadre du mot de passe haché */
        $this->page = str_replace('{lastname}',$user['lastname'],$this->page);
        $this->page = str_replace('{firstname}',$user['firstname'],$this->page);
        $this->page = str_replace('{email}',$user['email'],$this->page);
        $this->displayPage();
    }

}
