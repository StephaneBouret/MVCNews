<?php

session_start();

include 'View/View.php';
include 'Model/Model.php';
include 'Controller/Controller.php';

include 'Controller/CategoryController.php';
include 'Controller/NewController.php';
include 'Controller/UserController.php';
include 'Controller/SecurityController.php';

$paramGet = extractParameters();
$controller = $paramGet['controller'];
$action = $paramGet['action'];

$controller = new $controller();

$controller->$action();

function extractParameters()
{

    $controllerNotAuth = ['NewController', 'SecurityController'];
    $actionNotAuth = ['start', 'modal', 'formLogin', 'login', 'formForget', 'forget', 'formReset', 'reset'];

    /**
     * récupération des données de l'url
     */
    if (isset($_GET['controller'])) {
        $controller = ucfirst($_GET['controller']) . "Controller";
    } else {
        $controller = 'NewController';
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'start';
    }

    /**
     * validation selon les droits établis si l'utilisateur n'est pas authentifié
     */
    if (!isset($_SESSION['user'])) {
        if (!in_array($controller, $controllerNotAuth) || !in_array($action, $actionNotAuth)) {
            $controller = 'SecurityController';
            $action = "formLogin";
        }
    }

    return (['controller' => $controller, 'action' => $action]);
}

// if (isset($_GET['controller'])) {
//     $controllerStart = ucfirst($_GET['controller']) . "Controller";
// }
// else {
//     $controllerStart = 'NewController';
// }

// if (!isset($_SESSION['user']) && 
// ($controllerStart != 'SecurityController')){
//     $controllerStart = 'NewController';
//     $_GET['action'] = "start";
// }
// if (!isset($_SESSION['user']) && 
// ($_GET['action'] != "start" && $_GET['action'] != "formLogin" && $_GET['action'] != 'login' && $_GET['action'] != 'modal')){
//     $controllerStart = 'NewController';
//     $_GET['action'] = "start";
// }

// $controller = new $controllerStart();
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];
// }
// else {
//     $action = 'start';
// }

// var_dump($action);
// var_dump($controller);

// $controller->start();
// $controller->addForm();
// $controller->$action();