<?php

require_once('./order/controller/ControllerRegistry.php');

// Récupère l'url actuelle et supprime le chemin de base
$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/projet-methodo-tp-1/', '', $uri);
$endUri = trim($endUri, '/');

$orderControllers = new OrderControllerRegistry();

switch ($endUri) {
    case "":
        $orderControllers->indexController->index();
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
