<?php


class OrderFormController {

	public function orderForm() {

		try{

		$productsRepository = new ProductsRepository();
		$products = $productsRepository->getAllProducts();
		
		require_once('./order/view/order-form.php');

	} catch (Exception $e) {
		handleException($e);
	}
	}

}



