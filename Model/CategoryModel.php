<?php

class CategoryModel extends Model {

    /**
     * Fonction ajout de donnée dans la BDD
     *
     * @return void
     */
    public function addDB()
    {
        // insert l'info
        $name = $_POST['name'];
        $description = $_POST['description'];

        $requete = $this->connexion->prepare("INSERT INTO category
        VALUES (NULL, :name, :description)");
        $requete->bindParam(':name', $name);
        $requete->bindParam(':description', $description);
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

        $requete = $this->connexion->prepare("DELETE FROM category
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
    public function getCategory(){
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT *
        FROM category
        WHERE id=:id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        $cat = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($cat);
        return $cat;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $requete = $this->connexion->prepare("UPDATE category
        SET name = :name, description = :description
        WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':name', $name);
        $requete->bindParam(':description', $description);
        $result = $requete->execute();
        // var_dump($result);
    }
}