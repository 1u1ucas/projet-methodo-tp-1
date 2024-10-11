<?php

require_once './order/model/entity/Order.php'; 
require_once './order/model/repository/OrderRepository.php';


class ProcessShippingMethodController
{
    public function processShippingMethod()
    {
        try {
        
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }

           
            if (!isset($_POST['shippingMethod'])) {
                $errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
                
                require_once './order/view/order-error.php';
                return;
            }

            $shippingMethod = $_POST['shippingMethod'];
          
            $order->setShippingMethod($shippingMethod);

            $orderRepository->persist($order);

            require_once './order/view/shipping-method-added.php';

        } catch (Exception $e) {
            handleException($e);
        }
    }
}
