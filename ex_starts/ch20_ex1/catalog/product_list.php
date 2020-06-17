<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<section>
    <h1><?php echo $current_category['categoryName']; ?></h1>
    <?php if (count($products) == 0) : ?>
        <ul><li>There are no products in this category.</li></ul>
    <?php else: ?>
        <ul>
        <?php foreach ($products as $product) : ?>
        <li>
            <a href="?action=view_product&amp;product_id=<?php
                      echo $product['productID']; ?>">
                <?php echo $product['productName']; ?>
            </a>
        </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
<?php include '../view/footer.php'; ?>