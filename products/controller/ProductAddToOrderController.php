<?php
require_once './order/model/repository/OrderRepository.php';
require_once './products/model/repository/ProductsRepository.php';

class ProductAddToOrderController {

    function productAddToOrderController() {

        try{

if (!isset($_POST['productId'])) {
    require_once '/projet-methodo-tp-1/product-available-view';
    exit;
}

$productId = $_POST['productId'];




$orderRepository = new OrderRepository();
$order = $orderRepository->find();

if (!$order) {
    // Rediriger vers la page de création de commande si la commande n'est pas trouvée
    require_once './order/view/order-form.php';
    exit;
}

// Ajouter le produit à la commande
$order->addProduct($productId);
$orderRepository->persist($order);

// Rediriger vers la page de la commande
require_once './order/view/order-form.php';

} catch (Exception $e) {
    handleException($e);
}
    }
}