<?php

require_once('./products/controller/ProductFormController.php'); 
require_once('./products/controller/ProcessProductCreate.php');
require_once('./products/controller/ViewProductController.php');



class ProductsControllerRegistry {

    public $productForm;

    public $createProduct;

    public $viewProduct;

    public function __construct() {
        $this->productForm = new ProductFormController();
        $this->createProduct = new CreateProductController();
        $this->viewProduct = new ViewProductController();
    }

}