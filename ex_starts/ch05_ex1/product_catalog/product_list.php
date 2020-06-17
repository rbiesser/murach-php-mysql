<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Categories</h1>
        <nav>
        <ul>
            <!-- display links for all categories -->
            <?php foreach($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
    </aside>
    <section>
        <h1><?php echo $category_name; ?></h1>
        <ul class="nav">
            <!-- display links for products in selected category -->
            <?php foreach ($products as $product) : ?>
            <li>
                <a href="?action=view_product&amp;product_id=<?php 
                          echo $product['productID']; ?>">
                    <?php echo $product['productName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
<?php include '../view/footer.php'; ?>