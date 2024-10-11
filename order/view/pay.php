<?php 
require_once('./order/view/partials/header.php'); 

$orderRepository = new OrderRepository();
$order = $orderRepository->find();

if ($order === null) {
	var_dump($_SESSION);
	exit;
}

?>
	
	<main>
		<h3>récap de votre commande</h3>
	

		<p>Payer la commande (c'est même pas débité sur votre compte. Ou peut être que si. Mais faites confiance) </p>

		<h4>Détails de la commande</h4>
    	<p>Nom du client : <?= htmlspecialchars($order->getCustomerName()) ?></p>
		<p>Produits : </p>
		<ul>

			<?php $products =  $order->getProducts() ;
			?>

			<?php foreach ($products as $product) : 
				
				$product = $orderRepository->getProductById($product);
				$productTitle = $product->getTitle();
				$productPrice = $product->getPrice();
				
				?>
				<li><?= htmlspecialchars($productTitle) ?> - <?= htmlspecialchars($productPrice) ?> €</li>
				<?php endforeach; ?>	
				</ul>

    	<p>Prix total : <?= htmlspecialchars($order->getTotalPrice()) ?> €</p>	


		<form method="POST" action="/projet-methodo-tp-1/order-process-payment">

			<label for="payment"></label>

			<button type="submit">Payer</button>

		</form>
	</main>

<?php require_once('./order/view/partials/footer.php'); ?>