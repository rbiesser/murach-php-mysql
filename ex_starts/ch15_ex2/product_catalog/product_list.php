<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Categories</h1>
        <nav>
        <ul>
            <!-- display links for all categories -->
            <?php foreach($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category->getID(); ?>">
                    <?php echo $category->getName(); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
    </aside>
    <section>
        <h1><?php echo $current_category->getName(); ?></h1>
        <nav>
        <ul>
            <?php foreach ($products as $product) : ?>
            <li>
                <a href="?action=view_product&product_id=<?php
                          echo $product->getID(); ?>">
                    <?php echo $product->getName(); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
    </section>
</main>
<?php include '../view/footer.php'; ?>