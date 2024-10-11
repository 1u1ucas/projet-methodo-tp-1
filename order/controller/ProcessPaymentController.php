<?php

require_once './order/model/entity/Order.php'; 
require_once './order/model/repository/OrderRepository.php';

class ProcessPaymentController
{
	public function processPayment()
	{
		try {

		$orderRepository = new OrderRepository();
		$order = $orderRepository->find();

		if (!$order) {
			require_once './order/view/404.php';
			return;
		}

		
		$order->pay();
			$orderRepository->persist($order);
			require_once './order/view/paid.php';

		} catch (Exception $e) {
			handleException($e);
		}
	}
}
