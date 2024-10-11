<?php

require_once './order/model/repository/OrderRepository.php';

class SetShippingAddressController
{
    public function setShippingAddress()
    {
        try {

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }

        require_once './order/view/order-set-shipping-address.php';
    } catch (Exception $e) {
        handleException($e);
    }
    }
}
