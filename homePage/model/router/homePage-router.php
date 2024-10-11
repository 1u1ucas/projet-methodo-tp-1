<?php

require_once('./homePage/controller/ControllerRegistry.php');
require_once('./homePage/controller/IndexController.php');
require_once('./homePage/controller/ErrorController.php');


class HomePageRouter {

    private $homePageControllers;

    public function __construct() {
        $this->homePageControllers = new HomePageControllerRegistry();
    }

    public function handleRequest($uri) {
        switch ($uri) {
            case "":
                $this->homePageControllers->indexController->index();
                break;
            case "error":
                $this->homePageControllers->errorController->errorController();
                break;
            default:
                // Gestion des routes non trouvées pour la page d'accueil
                http_response_code(404);
                echo "404 Home Page Not Found";
                break;
        }
    }
}
