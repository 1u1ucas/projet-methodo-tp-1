<?php

require_once './products/view/partials/header.php' ; 
require_once './products/model/repository/ProductsRepository.php' ;
?>

<main>
    <H2>voila la liste des produits disponible</H2>

    <table class="table">
        <thead>
            <tr style="
    display: flex;
    gap: 66px;
">
                <th>Titre</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody style="display:flex; flex-direction:column; gap:20px">
        <?php echo  $productsListAvailable ?>
        </tbody>
    </table>
</main>

<?php require_once './products/view/partials/footer.php'; ?>    