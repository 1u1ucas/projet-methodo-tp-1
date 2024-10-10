<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./homePage/controller/ControllerRegistry.php');
require_once('./order/controller/ControllerRegistry.php');
require_once('./products/controller/ControllerRegistry.php');


// Récupère l'url actuelle et supprime le chemin de base
$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/projet-methodo-tp-1/', '', $uri);
$endUri = trim($endUri, '/');

$homePageControllers = new homePageControllerRegistry();
$orderControllers = new OrderControllerRegistry();
$productControllers = new ProductsControllerRegistry();


switch ($endUri) {

    // Route pour la page d'accueil

    case "":
        $homePageControllers->indexController->index();
        break;

    // Route pour les produits

    case "product-form":
        $productControllers->productForm->productForm();
        break;
    case "create-product":
        $productControllers->createProduct->createProduct();
        break;
    case "view-product":
        $productControllers->viewProduct->viewProduct();
        break;


    // Route pour les commandes

    case "order-form":
        $orderControllers->orderFormController->orderForm();
        break;

    case "create-order":
        $orderControllers->createOrderController->createOrder();
        break;

    case "pay":
        $orderControllers->payController->pay();
        break;

    case "process-payment":
        $orderControllers->processPaymentController->processPayment();
        break;

    case "process-shipping-address":
        $orderControllers->processShippingAddressController->processShippingAddress();
        break;

    case "process-shipping-method":
        $orderControllers->processShippingMethodController->processShippingMethod();
        break;

    case "set-shipping-address":
        $orderControllers->setShippingAddressController->setShippingAddress();
        break;

    case "set-shipping-method":
        $orderControllers->setShippingMethodController->setShippingMethod();
        break;

    default:
        // Gestion des erreurs ou des routes non trouvées
        http_response_code(404);
        echo "404 Not Found";
        break;
}
