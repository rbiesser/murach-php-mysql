<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>

<section>
    <h1>Product Manager - View Product</h1>
    
    <!-- display product -->
    <?php include '../../view/product.php'; ?>

    <!-- display buttons -->
    <div class="last_paragraph">
        <form action="." method="post" id="edit_button_form">
            <input type="hidden" name="action" value="show_add_edit_form"/>
            <input type="hidden" name="product_id"
                   value="<?php echo $product['productID']; ?>" />
            <input type="hidden" name="category_id"
                   value="<?php echo $product['categoryID']; ?>" />
            <input type="submit" value="Edit Product" />
        </form>
        <form action="." method="post" >
            <input type="hidden" name="action" value="delete_product"/>
            <input type="hidden" name="product_id"
                   value="<?php echo $product['productID']; ?>" />
            <input type="hidden" name="category_id" 
                   value="<?php echo $product['categoryID']; ?>" />
            <input type="submit" value="Delete Product"/>
        </form>
    </div>
</section>
<?php include '../../view/footer.php'; 