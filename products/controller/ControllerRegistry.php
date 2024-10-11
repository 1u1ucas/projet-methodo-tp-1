<?php

require_once('./products/controller/ProductFormController.php'); 
require_once('./products/controller/ProcessProductCreate.php');
require_once('./products/controller/ViewProductAvailableController.php');
require_once('./products/controller/ViewAllProductController.php');
require_once('./products/controller/UpdateProductAvailabilityController.php');



class ProductsControllerRegistry {

    public $productForm;

    public $createProduct;

    public $viewProductAvailable;

    public $viewAllProduct;

    public $updateProductAvailability;

    public function __construct() {
        $this->productForm = new ProductFormController();
        $this->createProduct = new CreateProductController();
        $this->viewProductAvailable = new ViewProductAvailableController();
        $this->viewAllProduct = new ViewAllProductController();
        $this->updateProductAvailability = new UpdateProductAvailabilityController();
    }

}