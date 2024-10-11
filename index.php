<?php

// gestion des erreurs   

require_once('./homePage/model/router/homePage-router.php'); // Charger HomePageRouter
require_once('./order/model/router/order-router.php'); // Charger OrderRouter
require_once('./products/model/router/product-router.php'); // Charger ProductRouter

// Récupère l'url actuelle et supprime le chemin de base
$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/projet-methodo-tp-1/', '', $uri);
$endUri = trim($endUri, '/');

// Initialiser les routeurs
$homePageRouter = new HomePageRouter(); // Utilisation du HomePageRouter
$orderRouter = new OrderRouter(); // Utilisation du OrderRouter
$productRouter = new ProductRouter(); // Utilisation du ProductRouter

switch ($endUri) {

    // Route pour la page d'accueil (root "/")
    case "":
        $homePageRouter->handleRequest($endUri);
        break;

    // Routes produits (commençant par 'product')
    case (strpos($endUri, 'product') === 0):
        $productRouter->handleRequest($endUri);
        break;

    // Routes commandes (commençant par 'order')
    case (strpos($endUri, 'order') === 0):
        $orderRouter->handleRequest($endUri);
        break;

    // Gestion des erreurs ou des routes non trouvées
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}