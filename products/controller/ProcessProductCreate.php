<?php 

require_once('./products/model/entity/Products.php');
require_once('./products/model/repository/ProductsRepository.php');

class CreateProductController{

    public function createProduct() {  

        try {

			if (!isset($_POST['title']) || !isset($_POST['description'])) {
				$errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
				
				require_once './products/view/product-error.php';
				return;
			}

            $title = $_POST['title'];
            $price = isset($_POST['price']) ? $_POST['price'] : 2.0;
            $description = $_POST['description'];
            $available = isset($_POST['available']) && $_POST['available'] === 'true' ? true : false;

            if (!is_string($title)) {
                throw new Exception("Le titre doit être une chaîne de caractères.");
            }
            if (!is_numeric($price)) {
                throw new Exception("Le prix doit être un nombre.");
            }
            if (!is_string($description)) {
                throw new Exception("La description doit être une chaîne de caractères.");
            }
            if (!is_bool($available)) {
                throw new Exception("La disponibilité doit être un booléen.");
            }

            // dans le constructeur
            $productId = uniqid('product_', true);

            $product = new Products($title, $price, $description, $available, $productId);

            $productRepository = new ProductsRepository();

            
            $productRepository->persist($product);





			require_once './products/view/product-confirm.php';

		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
            var_dump($e);
			require_once './products/view/product-error.php';
		}
     }
}