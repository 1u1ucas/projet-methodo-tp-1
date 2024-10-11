<?php 

require_once('./products/controller/ControllerRegistry.php');
require_once('./products/controller/ProductFormController.php');
require_once('./products/controller/ProcessProductCreate.php');
require_once('./products/controller/ViewProductAvailableController.php');
require_once('./products/controller/ViewAllProductController.php');
require_once('./products/controller/UpdateProductAvailabilityController.php');

class ProductRouter {

    private $productControllers;

    public function __construct() {
        $this->productControllers = new ProductsControllerRegistry();
    }

    public function handleRequest($uri) {
        switch ($uri) {
            case "product-form":
                $this->productControllers->productForm->productForm();
                break;

            case "product-create":
                $this->productControllers->createProduct->createProduct();
                break;

            case "product-available-view":
                $this->productControllers->viewProductAvailable->viewProductAvailable();
                break;

            case "product-view-all":
                $this->productControllers->viewAllProduct->viewAllProduct();
                break;

            case "product-update-availability":
                $this->productControllers->updateProductAvailability->updateProductAvailability();
                break;
            case "product-add-to-order":
                $this->productControllers->productAddToOrder->productAddToOrderController();
                break;

            default:
                // Gestion des routes non trouvées pour les produits
                http_response_code(404);
                echo "404 Product Not Found";
                break;
        }
    }
}