<?php require_once('./products/view/partials/header.php'); 



?>

<main>

    <H2>voici le produit que vous avec crée</H2>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $product->getTitle() ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= $product->getPrice() ?> €</h6>
            <p class="card-text"><?= $product->getDescription() ?></p>
            <p class="card-text"><?= $product->isAvailable() ? 'Disponible' : 'Indisponible' ?></p>
        </div>
    </div>


</main>

<?php require_once('./products/view/partials/footer.php'); ?>