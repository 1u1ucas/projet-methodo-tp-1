<?php

class ViewAllProductController {

    public function viewAllProduct() {

        $productRepository = new ProductsRepository();
                $products = $productRepository->getAllProducts();

        require_once('./products/view/product-view-all.php');
    }

}