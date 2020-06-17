<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <h1><?php echo htmlspecialchars($category_name); ?></h1>
    <?php if (count($products) == 0) : ?>
        <p>There are no products in this category.</p>
    <?php else: ?>
        <?php foreach ($products as $product) : ?>
        <p>
            <a href="<?php echo '?product_id=' . $product['productID']; ?>">
                <?php echo htmlspecialchars($product['productName']); ?>
            </a>
        </p>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php include '../view/footer.php'; ?>