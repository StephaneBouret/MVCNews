<?php

class SecurityModel extends Model {

    /**
     * Fonction test Login
     *
     * @return void
     */
    public function testlogin(){
        unset($_SESSION['flash']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        /** Cadre général */
        // $requete = $this->connexion->prepare("SELECT *
        // FROM user
        // WHERE username=:username AND password=:password");
        $requete = $this->connexion->prepare("SELECT *
        FROM user
        WHERE username=:username");
        $requete->bindParam(':username', $username);
        /** Cadre général */
        // $requete->bindParam(':password', $password);
        $result = $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);
        /** Cadre général */
        // if ($user != false) {
        //     $_SESSION['user'] = $user;
        // }
        // var_dump($_SESSION);
        // return $user;
        if ($user != false && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
        }
        // var_dump($_SESSION);
        return $user;
    }
    /**
     * Fonction déconnexion
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['flash']);
    }

    /**
     * Fonction pour tester si le mail renseigné existe dans la BDD pour la modif du password
     *
     * @return void
     */
    public function testForget()
    {
        unset($_SESSION['user']);
        unset($_SESSION['flash']);
        $email = $_POST['email'];

        if(!empty($_POST) && !empty($email)){
            $requete = $this->connexion->prepare("SELECT *
            FROM user WHERE email = :email");
            $requete->bindParam(':email', $email);
            $result = $requete->execute();
            $userForget = $requete->fetch(PDO::FETCH_ASSOC);
            // var_dump($userForget);
            if ($userForget) {
                $_SESSION['userForget'] = $userForget;
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
            }
            var_dump($_SESSION);
        } else {
            $_SESSION['flash']['danger'] = 'Merci de renseigner votre adresse email';
        }
        return $userForget;
    }

    public function resetPW()
    {
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'];
        $id = $_SESSION['userForget']['id'];
        // var_dump($id);
        if (!empty($password)) {
            if($password == $passwordConfirm){
                $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
                $requete = $this->connexion->prepare("UPDATE user
                SET password = :password
                WHERE id = :id");
                $requete->bindParam(':id', $id);
                $requete->bindParam(':password', $encryptedPassword);
                $userReset = $requete->execute();
                if ($userReset) {
                    $_SESSION['flash']['success'] = 'Les modifications ont été prises en compte';
                    unset($_SESSION['userForget']);
                }
        } 
        else {
            $_SESSION['flash']['alert'] = 'Les mots de passe ne correspondent pas';
        }
        } else {
            $_SESSION['flash']['alert'] = 'Merci de renseigner votre mot de passe';
        }
        return $userReset;
    }
}