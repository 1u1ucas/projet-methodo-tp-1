<?php

require_once('./order/controller/IndexController.php');
require_once('./order/controller/ProcessOrderCreateController.php');
require_once('./order/controller/PayController.php');
require_once('./order/controller/ProcessPaymentController.php');
require_once('./order/controller/ProcessShippingAddressController.php');
require_once('./order/controller/ProcessShippingMethodController.php');
require_once('./order/controller/SetShippingAddressController.php');
require_once('./order/controller/SetShippingMethodController.php'); 



class OrderControllerRegistry {
    public $indexController;
    public $createOrderController;
    public $payController;
    public $processPaymentController;
    public $processShippingAddressController;
    public $processShippingMethodController;
    public $setShippingAddressController;
    public $setShippingMethodController;

    public function __construct() {
        $this->indexController = new IndexController();
        $this->createOrderController = new CreateOrderController();
        $this->payController = new PayController();
        $this->processPaymentController = new ProcessPaymentController();
        $this->processShippingAddressController = new ProcessShippingAddressController();
        $this->processShippingMethodController = new ProcessShippingMethodController();
        $this->setShippingAddressController = new SetShippingAddressController();
        $this->setShippingMethodController = new SetShippingMethodController();
    }
}