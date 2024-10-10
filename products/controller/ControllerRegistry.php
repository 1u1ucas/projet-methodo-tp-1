<?php

require_once './homePage/controller/IndexController.php';    


class HomePageControllerRegistry {

    public $indexController;

    public function __construct() {
        $this->indexController = new IndexController();
    }

}