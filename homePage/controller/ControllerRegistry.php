<?php

require_once './homePage/controller/IndexController.php';
require_once './homePage/controller/ErrorController.php'; 


class HomePageControllerRegistry {

    public $indexController;

    public $errorController;

    public function __construct() {
        $this->indexController = new IndexController();
        $this->errorController = new ErrorController();
    }

}