<?php

require_once('./order/controller/ControllerRegistry.php');
require_once('./order/controller/OrderFormController.php');
require_once('./order/controller/ProcessOrderCreateController.php');
require_once('./order/controller/PayController.php');
require_once('./order/controller/ProcessPaymentController.php');
require_once('./order/controller/ProcessShippingAddressController.php');
require_once('./order/controller/ProcessShippingMethodController.php');
require_once('./order/controller/SetShippingAddressController.php');
require_once('./order/controller/SetShippingMethodController.php');

class OrderRouter {

    private $orderControllers;

    public function __construct() {
        $this->orderControllers = new OrderControllerRegistry();
    }

    public function handleRequest($uri) {
        switch ($uri) {
            case "order-form":
                $this->orderControllers->orderFormController->orderForm();
                break;

            case "order-create":
                $this->orderControllers->createOrderController->createOrder();
                break;

            case "order-pay":
                $this->orderControllers->payController->pay();
                break;

            case "order-process-payment":
                $this->orderControllers->processPaymentController->processPayment();
                break;

            case "order-process-shipping-address":
                $this->orderControllers->processShippingAddressController->processShippingAddress();
                break;

            case "order-process-shipping-method":
                $this->orderControllers->processShippingMethodController->processShippingMethod();
                break;

            case "order-set-shipping-address":
                $this->orderControllers->setShippingAddressController->setShippingAddress();
                break;

            case "order-set-shipping-method":
                $this->orderControllers->setShippingMethodController->setShippingMethod();
                break;

            default:
                // Gestion des routes non trouvées pour les commandes
                http_response_code(404);
                echo "404 Order Not Found";
                break;
        }
    }
}
