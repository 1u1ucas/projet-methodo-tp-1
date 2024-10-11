<?php

require_once './products/view/partials/header.php' ; 

?>

<main>
    <H2>voila la liste de tout les produits</H2>

    <table class="table">
        <tbody>
            <?php 
                $productRepository = new ProductsRepository();
                $products = $productRepository->getAllProducts();

                if (empty($products)) : 
                    ?>
                        <tr>
                            <td colspan="5" class="text-center">Aucun produit disponible.</td>
                        </tr>
                    <?php else : 
                foreach ($products as $product) : 
                  
                ?>
                <tr>
                    <td><?php echo $product->getTitle(); ?></td>
                    <td><?php echo $product->getPrice(); ?></td>
                    <td><?php echo $product->getDescription(); ?></td>
                    <td>
                        <form method="POST" action="/projet-methodo-tp-1/product-update-availability">
                            <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product->getProductId()); ?>">
                            <input type="checkbox" name="isAvailable" value="1" <?php echo $product->isAvailable() ? 'checked' : ''; ?> onchange="this.form.submit()">
                        </form>
                    </td>
                </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
</main>

<?php require_once './products/view/partials/footer.php'; ?>    