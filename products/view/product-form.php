<?php require_once  './products/view/partials/header.php'; ?>

<main>

    <h1>crée un produit</h1>
    <form action="/projet-methodo-tp-1/create-product" method="post">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="available">En stock</label>
            <input type="hidden" name="available" value="false">
            <input type="checkbox" class="form-control" id="available" name="available" value="true">
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>

</main>

<?php require_once  './products/view/partials/footer.php'; ?>