<?php

require_once './products/model/repository/ProductsRepository.php';

class UpdateProductAvailabilityController {
    public function updateProductAvailability() {

try {

    if (!isset($_POST['productId']) || !isset($_POST['isAvailable'])) {
        throw new Exception("Données invalides.");
    }

    $productId = $_POST['productId'];
    $isAvailable = $_POST['isAvailable'] === '1';

    $productRepository = new ProductsRepository();
    $productRepository->updateProductAvailability($productId, $isAvailable);

    require_once './products/view/product-view-all.php';
    exit;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
    }
}