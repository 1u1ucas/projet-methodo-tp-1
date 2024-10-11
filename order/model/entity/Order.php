<?php

class Order {

	public static $CART_STATUS = "CART";
	public static $SHIPPING_ADDRESS_SET_STATUS = "SHIPPING_ADDRESS_SET";
	public static $SHIPPING_METHOD_SET_STATUS = "SHIPPING_METHOD_SET";
	public static $PAID_STATUS = "PAID";
	public static $MAX_PRODUCTS_BY_ORDER = 5;
	public static $BLACKLISTED_CUSTOMERS = ['David Robert'];
	public static $AUTORIZED_SHIPPING_COUNTRIES = ['France', 'Belgique', 'Luxembourg'];
	public static $AVAILABLE_SHIPPING_METHODS = ['Chronopost Express', 'Point relais', 'Domicile'];
	public static $PAID_SHIPPING_METHOD = 'Chronopost Express';
	public static $PAID_SHIPPING_METHODS_COST = 5;

	private array $products;

	private string $customerName;

	private float $totalPrice;
	private DateTime $createdAt;

	private string $status;

	private ?string $shippingMethod;

	private ?string $shippingCity;

	private ?string $shippingAddress;

	private ?string $shippingCountry;

	public function __construct(string $customerName, array $products) {

		if (count($products) > Order::$MAX_PRODUCTS_BY_ORDER) {
			throw new Exception("Vous ne pouvez pas commander plus de " . Order::$MAX_PRODUCTS_BY_ORDER . " produits");
		}

		if (in_array($customerName, Order::$BLACKLISTED_CUSTOMERS)) {
			throw new Exception("Vous êtes blacklisté");
		}

		$this->status = Order::$CART_STATUS;
		$this->createdAt = new DateTime();
		$this->products = $products;
		$this->customerName = $customerName;
		$this->totalPrice = $this->calculateTotalCart($products);
		$this->shippingAddress = null;
		$this->shippingCity = null;
		$this->shippingCountry = null;
		$this->shippingMethod = null;
	}



	private function calculateTotalCart($products):  float {
		$this->totalPrice = 0.0;
        $orderRepository = new OrderRepository();

        foreach ($this->products as $productId) {
            $product = $orderRepository->getProductById($productId);

            if (method_exists($product, 'getPrice')) {
                $this->totalPrice += $product->getPrice();
            } else {
                throw new Exception("Le produit n'a pas de prix défini");
            }
        }
        return $this->totalPrice;
    }


	public function removeProduct(string $product) {
		$this->removeProductFromList($product);
		$this->totalPrice = $this->calculateTotalCart($product);

		$productsAsString = implode(',', $this->products);
		echo "Liste des produits : {$productsAsString}</br></br>";
	}

	private function removeProductFromList(string $product) {
		if (($key = array_search($product, $this->products)) !== false) {
			unset($this->products[$key]);
		}
	}


	public function addProduct(string $productId) {


		if (count($this->products) >= Order::$MAX_PRODUCTS_BY_ORDER) {
			throw new Exception("Vous ne pouvez pas commander plus de " . Order::$MAX_PRODUCTS_BY_ORDER . " produits");
		}

        foreach ($this->products as $existingProduct) {
            if ($existingProduct === $productId) {
                throw new Exception("Le produit existe déjà dans le panier");
            }
        }
        $this->products[] = $productId;
        $this->totalPrice = $this->calculateTotalCart($productId);
    }

	private function isProductInCart(string $product): bool {
		return in_array($product, $this->products);
	}

	public function setShippingAddress(string $shippingCity, string $shippingAddress, string $shippingCountry): void {
		if ($this->status !== Order::$CART_STATUS) {
			throw new Exception(message: 'Vous ne pouvez plus modifier l\'adresse de livraison');
		}

		if (!in_array($shippingCountry, Order::$AUTORIZED_SHIPPING_COUNTRIES)) {
			throw new Exception(message: 'Vous ne pouvez pas commander dans ce pays');
		}

		$this->shippingAddress = $shippingAddress;
		$this->shippingCity = $shippingCity;
		$this->shippingCountry = $shippingCountry;
		$this->status = Order::$SHIPPING_ADDRESS_SET_STATUS;
	}

	public function setShippingMethod(string $shippingMethod): void {
		if ($this->status !== Order::$SHIPPING_ADDRESS_SET_STATUS) {
			throw new Exception(message: 'Vous ne pouvez pas choisir de méthode avant d\'avoir renseigné votre adresse');
		}

		if (!in_array($shippingMethod, Order::$AVAILABLE_SHIPPING_METHODS)) {
			throw new Exception(message: 'Méthode non valide');
		}

		if ($shippingMethod === Order::$PAID_SHIPPING_METHOD) {
			$this->totalPrice = $this->totalPrice + Order::$PAID_SHIPPING_METHODS_COST;
		}
		$this->shippingMethod = $shippingMethod;
		$this->status = Order::$SHIPPING_METHOD_SET_STATUS;
	}


	public function pay(): void {
		if ($this->status !== Order::$SHIPPING_METHOD_SET_STATUS) {
			throw new Exception(message: 'Vous ne pouvez pas payer avant d\'avoir renseigné la méthode de livraison');
		}

		$this->status = Order::$PAID_STATUS;
	}

	public function getProducts(): array {
		return $this->products;
	}

	public function getOrderInfos(): string {

		$customerName = $this->customerName;
		$productsIds = $this->products;
		$shippingAddress = $this->shippingAddress;
		$shippingCity = $this->shippingCity;
		$shippingCountry = $this->shippingCountry;
		$shippingMethod = $this->shippingMethod;
		$totalPrice = $this->totalPrice;
		$orderInfo = '';


		$orderRepository = new OrderRepository();
		foreach ($productsIds as $productId) {
			$products[] = $orderRepository->getProductById($productId);
		}

		$productsList = '<ul>';

		foreach ($products as $product) {
		$productTitle = $product->getTitle();
		$productPrice = $product->getPrice();
		$productsList .= '<li>' . htmlspecialchars($productTitle) . ' - ' . htmlspecialchars($productPrice) . ' €</li>';
		}
		$productsList .= '</ul>';
		if (!empty($shippingAddress) || !empty($shippingCity) || !empty($shippingCountry)) {
			$orderInfo .= '<p>Adresse de livraison : ' . htmlspecialchars($shippingAddress) . ', ' . htmlspecialchars($shippingCity) . ', ' . htmlspecialchars($shippingCountry) . '</p>';
		};

		if (!empty($shippingMethod)) {
			$orderInfo .= '<p>Méthode de livraison : ' . htmlspecialchars($shippingMethod) . '</p>';
		};

		return
		'<p>Nom du client : ' . htmlspecialchars($customerName) . '</p>
		<p>Produits : ' . $productsList . '</p>'. 
		$orderInfo .
		'<p>Prix total : ' . htmlspecialchars($totalPrice) . ' €</p>';
		
		}
}



