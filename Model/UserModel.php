<?php

class UserModel extends Model {

        /**
     * Fonction affichage de la BDD
     *
     * @return void
     */
    public function getUsers()
    {
        $requete = "SELECT * FROM user ORDER BY id";
        $result = $this->connexion->query($requete);
        $listUsers = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listUsers;
    }
    /**
     * Fonction ajout de donnée dans la BDD
     *
     * @return void
     */
    public function addDB()
    {
        // insert l'info
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        /** Cas Mot de passe crypté */
        $passwordC = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if(empty($_POST['password'])){
            return false;
        }
        else {
            $requete = $this->connexion->prepare("INSERT INTO user
            VALUES (NULL, :username, :password, :firstname, :lastname, :email)");
            $requete->bindParam(':username', $username);
            $requete->bindParam(':password', $passwordC);
            $requete->bindParam(':firstname', $firstname);
            $requete->bindParam(':lastname', $lastname);
            $requete->bindParam(':email', $email);
            $result = $requete->execute();
        }
        /** Cas général */
        // $requete = $this->connexion->prepare("INSERT INTO user
        // VALUES (NULL, :username, :password, :firstname, :lastname)");
        // $requete->bindParam(':username', $username);
        // $requete->bindParam(':password', $password);
        // $requete->bindParam(':firstname', $firstname);
        // $requete->bindParam(':lastname', $lastname);
        // $result = $requete->execute();
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

        $requete = $this->connexion->prepare("DELETE FROM user
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
    public function getUser(){
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT *
        FROM user
        WHERE id=:id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);
        return $user;
    }

    /**
     * Fonction update des données d'un utilisateur
     *
     * @return void
     */
    public function updateDB()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        /** Cas mot de pas crypté */
        $passwordC = password_hash($password, PASSWORD_BCRYPT);

        /** Cas général */
        // $requete = $this->connexion->prepare("UPDATE user
        // SET username = :username, password = :password,
        // firstname = :firstname, lastname = :lastname
        // WHERE id = :id");

        /** Cas mot de pas crypté */
        $requete = $this->connexion->prepare("UPDATE user
        SET username = :username, password = :password,
        firstname = :firstname, lastname = :lastname, email = :email
        WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $passwordC);
        // $requete->bindParam(':password', $password); /** Cas général */
        $requete->bindParam(':firstname', $firstname);
        $requete->bindParam(':lastname', $lastname);
        $requete->bindParam(':email', $email);
        $result = $requete->execute();
        // var_dump($result);
    }
}