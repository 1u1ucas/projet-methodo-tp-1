<?php

require_once './products/view/partials/header.php' ; 
require_once './products/model/repository/ProductsRepository.php' ;
?>

<main>
    <H2>voila la liste des produits disponible</H2>

    <table class="table">
        <tbody>
            <?php

                if (empty($products)) : 
                    ?>
                        <tr>
                            <td colspan="5" class="text-center">Aucun produit disponible.</td>
                        </tr>
                    <?php else : 
                foreach ($products as $product) : 
                    if (!$product->isAvailable()) {
                        continue;
                    }
                  
                ?>
                <tr>
                    <td><?php echo $product->getTitle(); ?></td>
                    <td><?php echo $product->getPrice(); ?></td>
                    <td><?php echo $product->getDescription(); ?></td>
                </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
</main>

<?php require_once './products/view/partials/footer.php'; ?>    