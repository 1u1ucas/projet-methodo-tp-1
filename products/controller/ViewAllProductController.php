<?php

class ViewAllProductController {

    public function viewAllProduct() {

        try {

        $productRepository = new ProductsRepository();
                $products = $productRepository->getAllProducts();

        require_once('./products/view/product-view-all.php');

    } catch (Exception $e) {
        handleException($e);
    }
    }

    

}