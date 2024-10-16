<?php

require_once './order/model/repository/OrderRepository.php';


class SetShippingMethodController
{
    public function setShippingMethod()
    {

        try{
        
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }

        require_once './order/view/order-set-shipping-method.php';

    } catch (Exception $e) {
        handleException($e);
    }
    }
}
