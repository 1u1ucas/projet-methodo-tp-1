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

	public function getAllProducts(): array {
		return $_SESSION['products'];
	}

	public function updateProductAvailability(string $productId, bool $isAvailable): void {
		if (isset($_SESSION['products'][$productId])) {
			$_SESSION['products'][$productId]->setAvailable($isAvailable);
		} else {
			throw new Exception("Produit non trouvé pour l'ID: $productId");
		}
	}



}
