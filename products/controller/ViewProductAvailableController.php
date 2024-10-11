<?php


class ViewProductAvailableController {

	public function viewProductAvailable() {


			try {	
	

		$productRepository = new ProductsRepository();
    	$products = $productRepository->getAllProducts();
		$orderRepository = new OrderRepository();
		$order = isset($_SESSION['order']) ? $orderRepository->find() : null;

		if (empty($products)){
            $productsListAvailable =  '<tr>
                            <td colspan="5" class="text-center">Aucun produit disponible.</td>
                        </tr>';
        } else {

			

		foreach ($products as $product) {
			$productsListAvailable .= '<tr style="display:flex; flex-direction:row; gap:20px">';
			
			$productsListAvailable .= $product->getAvailableProducts($product);
			$productsListAvailable .= '</tr>';
		};
		
		
		

		require_once('./products/view/product-available-view.php');
	};
	} catch (Exception $e) {
		handleException($e);
	}

  }
}