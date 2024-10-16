<?php

class Products {

	

	private string $title;

	private float $price;

	private string $id;
	private DateTime $createdAt;

	private bool $isAvailable;

	private string $description;

    private string $productId;

	public function __construct(string $title, ?float $price, ?string $description, ?bool $isAvailable, string $productId) {

        

        if (strlen($title) <= 3) {
            throw new Exception("Le titre doit contenir au moins 3 caractères");
        }

        if (!preg_match('/^[a-zA-Z0-9\s-]+$/', $title)) {
            throw new Exception("Le titre doit contenir uniquement des lettres et des chiffres");
        }

        $this->title = $title;

        if ($price !== null) {
            if ($price < 1 || $price > 500) {
                throw new Exception("Le prix doit être entre 1 et 500 euros");
            }
        }

        

        $defaultPrice = 2.0;

        $this->price = $price === null ? $defaultPrice : $price;

    
        if ($description === null) {
            throw new Exception("La description est obligatoire");
        }	

        $this->description = $description;

        $this->isAvailable = $isAvailable === null ? true : $isAvailable;

        $this->productId = $productId;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function isAvailable(): bool {
        return $this->isAvailable;
    }

    public function setAvailable(bool $isAvailable): void {
        $this->isAvailable = $isAvailable;
    }

    public function getProductId(): string {
        return $this->productId;
    }

    public function getAvailableProducts($product): string {

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        $productsList = '';
        
            if (!$product->isAvailable()) {
                return '';
            }

            $existingProductIds = $order ? $order->getProducts() : [];
            $productId = $product->getProductId();
            $productsList .= '<td>' . $product->getTitle() . '</td>';
            $productsList .= '<td>' . $product->getPrice() . '</td>';
            $productsList .= '<td>' . $product->getDescription() . '</td>';
            $productsList .= '<td>';
            if (!in_array($productId, $existingProductIds)) {
                $productsList .= '<form action="/projet-methodo-tp-1/product-add-to-order" method="post">';
                $productsList .= '<input type="hidden" name="productId" value="' . htmlspecialchars($productId) . '">';
                $productsList .= '<button type="submit" class="btn btn-primary">Ajouter à la commande</button>';
                $productsList .= '</form>';
            } else {
                $productsList .= '<span>Déjà dans la commande</span>';
            }
            $productsList .= '</td>';
        
        

        return $productsList;
    }
}

