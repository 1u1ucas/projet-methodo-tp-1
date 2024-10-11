<?php


class OrderFormController {

	public function orderForm() {

		$productsRepository = new ProductsRepository();
		$products = $productsRepository->getAllProducts();
		
		require_once('./order/view/order-form.php');
	}

}



