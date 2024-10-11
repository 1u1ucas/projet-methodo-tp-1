<?php

require_once './order/model/repository/OrderRepository.php';

class PayController
{
    public function pay()
    {
        try {

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();


        $productIds =  $order->getProducts() ;
        $products = [];


        $productRepository = new ProductsRepository();

        foreach ($productIds as $productId) {
            if (is_string($productId)) {

            
                $product = $productRepository->getProductById($productId);
                if ($product) {
                    $products[] = $product;
                }
            }
        }
        

        $orderInfos = $order->getOrderInfos();

		

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }

        require_once './order/view/pay.php';
    } catch (Exception $e) {
        handleException($e);
    }
    }
}
