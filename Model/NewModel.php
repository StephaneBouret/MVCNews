<?php

class NewModel extends Model {

    /**
     * Fonction affichage de la BDD
     *
     * @return void
     */
    public function getNews()
    {
        $requete = "SELECT news.*, category.id as id_category,
        category.name as name_category,
        category.description as description_category
        FROM news
        LEFT JOIN category
        ON news.category = category.id";
        $result = $this->connexion->query($requete);
        $listNews = $result->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($listNews);
        // $listNews = ['info1','info2','info3'];
        return $listNews;
    }

    /**
     * Fonction ajout de donnée dans la BDD
     *
     * @return void
     */
    public function addDB()
    {
        // insert l'info
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        if (empty($category)){
            $category=NULL;
        }
        
        $photo = "img\undefined.jpg";
        
        if (isset($_FILES['photo']) && !empty($_FILES['photo'])) {
            $emplacement_temporaire = $_FILES['photo']['tmp_name'];
            $nom_fichier = $_FILES['photo']['name'];
            // $emplacement_destination = 'C:\wamp64\www\cours\2019_DWWM\appCantine\img\\'. $nom_fichier;
            $emplacement_destination = 'img/'. $nom_fichier;
            // $emplacement_destination = 'img\\'. $nom_fichier;
            // var_dump($emplacement_temporaire);
            // var_dump($emplacement_destination);
            
            $result = move_uploaded_file ( $emplacement_temporaire , $emplacement_destination );
            if ($result) {
                $photo = 'img/'.$nom_fichier;
                // $photo = 'img\\'.$nom_fichier;
            }		
        }	

        $requete = $this->connexion->prepare("INSERT INTO news
        VALUES (NULL, :titre, :description, :photo, :category)");
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':photo',$photo);
        $requete->bindParam(':category', $category);
        $result = $requete->execute();
        // var_dump($result);
    }

    /**
     * Fonction suppression des données dans la BDD
     *
     * @return void
     */
    public function suppDB()
    {
        // insert l'info
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM news
        WHERE id=:id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        // var_dump($result);
    }
    /**
     * Fonction modification d'une donnée
     *
     * @return void
     */
    public function getNew(){
        $id = $_GET['id'];
        // $requete = $this->connexion->prepare("SELECT *
        // FROM news
        // WHERE id=:id");
        // $requete = $this->connexion->prepare("SELECT *
        // FROM news
        // JOIN category as categorie
        // ON news.category=categorie.id
        // WHERE news.id = :id");
    $requete = $this->connexion->prepare("SELECT news.*, categorie.name as name
    FROM news
    JOIN category as categorie
    ON news.category=categorie.id
    WHERE news.id = :id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        $new = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($new);
        return $new;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        if (empty($category)){
           
            $category=NULL;
        }
        $photo = "img\undefined.jpg";
        
        if (isset($_FILES['photo']) && !empty($_FILES['photo']) && ($_FILES['photo']['size']>0)) {
            $emplacement_temporaire = $_FILES['photo']['tmp_name'];
            $nom_fichier = $_FILES['photo']['name'];
            // $emplacement_destination = "C:\wamp64\www\php\PHP3\MVCSimpleBlog\img\\".$nom_fichier;
            $emplacement_destination = 'img/' . $nom_fichier;
            
            $resultat = move_uploaded_file ( $emplacement_temporaire , $emplacement_destination );
            if ($resultat) {
                $photo = 'img/'.$nom_fichier;
            }
            // var_dump($photo);
            // var_dump($resultat);
            $requete = $this->connexion->prepare("UPDATE news
            SET titre = :titre, description = :description, photo = :photo, category = :category
            WHERE id = :id");	
            $requete->bindParam(':photo', $photo);	
        }else {
            $requete = $this->connexion->prepare("UPDATE news 
            SET titre = :titre, description = :description, category = :category 
            WHERE id = :id");
        }	

        $requete->bindParam(':id', $id);
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':category', $category);
        $result = $requete->execute();
        
        // $requete = $this->connexion->prepare("UPDATE news
        // SET titre = :titre, description = :description, category = :category
        // WHERE id = :id");
        // $requete->bindParam(':id', $id);
        // $requete->bindParam(':titre', $titre);
        // $requete->bindParam(':description', $description);
        // $requete->bindParam(':category', $category);
        // $result = $requete->execute();
        // var_dump($result);
    }

}