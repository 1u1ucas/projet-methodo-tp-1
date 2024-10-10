<?php

require_once('./order/controller/OrderFormController.php');
require_once('./order/controller/ProcessOrderCreateController.php');
require_once('./order/controller/PayController.php');
require_once('./order/controller/ProcessPaymentController.php');
require_once('./order/controller/ProcessShippingAddressController.php');
require_once('./order/controller/ProcessShippingMethodController.php');
require_once('./order/controller/SetShippingAddressController.php');
require_once('./order/controller/SetShippingMethodController.php'); 



class OrderControllerRegistry {
    public $orderFormController;
    public $createOrderController;
    public $payController;
    public $processPaymentController;
    public $processShippingAddressController;
    public $processShippingMethodController;
    public $setShippingAddressController;
    public $setShippingMethodController;

    public function __construct() {
        $this->orderFormController = new OrderFormController();
        $this->createOrderController = new CreateOrderController();
        $this->payController = new PayController();
        $this->processPaymentController = new ProcessPaymentController();
        $this->processShippingAddressController = new ProcessShippingAddressController();
        $this->processShippingMethodController = new ProcessShippingMethodController();
        $this->setShippingAddressController = new SetShippingAddressController();
        $this->setShippingMethodController = new SetShippingMethodController();
    }
}