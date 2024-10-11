<?php 
require_once('./order/view/partials/header.php'); 
require_once('./order/model/repository/OrderRepository.php');
require_once('./products/model/repository/ProductsRepository.php');
?>
<main>

		<h1>Créer une commande</h1>

		<form method="POST" action="/projet-methodo-tp-1/order-create">

			<label for="customerName">Nom du client</label>
			<input type="text" id="customerName" name="customerName" required>
			<br>

			<label for="product">Produit</label>

			<select id="product" name="products[]" multiple>
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
					$productId = $product->getProductId();

                    if ($product->isAvailable()) {
						
                        echo '<option value="' . htmlspecialchars($productId) . '">' . htmlspecialchars($product->getTitle()) . ' - ' . htmlspecialchars($product->getPrice()) . ' €</option>';
                    }
                }
                
            } else {
                echo '<option value="" disabled>Aucun produit disponible</option>';
            }
            ?>
        </select>
			<br>

			<button type="submit">Ajouter</button>

		</form>

	</main>

<?php require_once('./order/view/partials/footer.php'); ?>