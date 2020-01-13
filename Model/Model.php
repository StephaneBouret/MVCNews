<?php

abstract class Model {

    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "test";

    protected $connexion;
    /**
     * Connexion à la base de donnée
     * Connecting to the database
     */
    public function __construct()
    {
    // connexion à la base en PHP en local ou à distance
    // define('SERVER' ,"localhost");
    // define('USER' ,"root");
    // define('PASSWORD' ,
    // "");
    // define('BASE' ,"test");

    // define('SERVER' ,"sqlprive-pc2372-001.privatesql.ha.ovh.net");
    // define('USER' ,"cefiidev966");
    // define('PASSWORD' ,"4Lwc5pW3");
    // define('BASE' ,"cefiidev966");

    try
    {
    $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE, self::USER, self::PASSWORD);
    $this->connexion->exec("SET NAMES 'UTF8'");
    }
    catch (Exception $e)
    {
    echo 'Erreur : ' . $e->getMessage();
    }
    }

        /**
     * Fonction affichage de la BDD
     *
     * @return void
     */
    public function getCategories()
    {
        $requete = "SELECT * FROM category";
        $result = $this->connexion->query($requete);
        $listNews = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listNews;
    }

}