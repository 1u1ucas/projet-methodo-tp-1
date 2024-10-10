<?php

require_once('./products/controller/ProductFormController.php'); 
require_once('./products/controller/ProcessProductCreate.php');



class ProductsControllerRegistry {

    public $productForm;

    public $createProduct;

    public function __construct() {
        $this->productForm = new ProductFormController();
        $this->createProduct = new CreateProductController();
    }

}