<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<section>
    <h1>Product Manager - List Products</h1>
    <p>To view, edit, or delete a product, select the product.</p>
    <p>To add a product, select the "Add Product" link.</p>
    <?php if (count($products) == 0) : ?>
        <ul><li>There are no products for this category.</li></ul>
    <?php else : ?>
        <h2><?php echo $current_category['categoryName']; ?></h2>
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

    <h2>Links</h2>
    <p class="last_paragraph">
        <a href="index.php?action=show_add_edit_form">Add Product</a>
    </p>
</section>
<?php include '../../view/footer.php'; ?>