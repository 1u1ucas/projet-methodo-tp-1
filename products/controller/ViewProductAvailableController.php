<?php


class ViewProductAvailableController {

	public function viewProductAvailable() {


		$productRepository = new ProductsRepository();
    	$products = $productRepository->getAllProducts();

		require_once('./products/view/product-available-view.php');
	}

}