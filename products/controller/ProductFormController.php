<?php


class ProductFormController {

	public function productForm() {

		try {
		require_once('./products/view/product-form.php');

	} catch (Exception $e) {
		handleException($e);
	}
	}

}



