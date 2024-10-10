<?php

require_once './products/model/entity/Products.php';


class ProductsRepository {

	public function __construct() {
		session_start();
	}

	public function persist(Products $product): Products {

		
		$productId = $product->getProductId();

		$_SESSION['products'][$productId] = $product;

		$_SESSION['lastProductId'] = $productId;

		return $product;

	}

	public function getProductById(string $productId): Products {
		return $_SESSION['products'][$productId];
	}



}
