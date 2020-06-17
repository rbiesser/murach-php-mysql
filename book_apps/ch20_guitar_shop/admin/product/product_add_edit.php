<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<?php
if (isset($product_id)) {
    $heading_text = 'Edit Product';
} else {
    $heading_text = 'Add Product';
}
?>
<section>
    <h1>Product Manager - <?php echo $heading_text; ?></h1>
    <form action="index.php" method="post" id="add_edit_product_form">
        <?php if (isset($product_id)) : ?>
            <input type="hidden" name="action" value="update_product" />
            <input type="hidden" name="product_id"
                   value="<?php echo $product_id; ?>" />
        <?php else: ?>
            <input type="hidden" name="action" value="add_product" />
        <?php endif; ?>
            <input type="hidden" name="category_id"
                   value="<?php echo $product['categoryID']; ?>" />

        <label>Category:</label>
        <select name="category_id">
        <?php foreach ($categories as $category) : 
            if ($category['categoryID'] == $product['categoryID']) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $category['categoryID']; ?>" <?php
                      echo $selected ?>>
                <?php echo $category['categoryName']; ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label>Code:</label>
        <input type="text" name="code"
               value="<?php echo htmlspecialchars(
                       $product['productCode']); ?>"><br>

        <label>Name:</label>
        <input type="text" name="name" 
               value="<?php echo htmlspecialchars(
                       $product['productName']); ?>"><br>

        <label>List Price:</label>
        <input type="text" name="price" 
               value="<?php echo $product['listPrice']; ?>"><br>

        <label>Discount Percent:</label>
        <input type="text" name="discount_percent" 
               value="<?php echo $product['discountPercent']; ?>"><br>

        <label>Description:</label>
        <textarea name="description" 
                  rows="10"><?php echo htmlspecialchars(
                            $product['description']); ?></textarea><br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
    </form>
    
    <div id="formatting_directions">
        <h2>How to format the Description entry</h2>
        <ul>
            <li>Use two returns to start a new paragraph.</li>
            <li>Use an asterisk to mark items in a bulleted list.</li>
            <li>Use one return between items in a bulleted list.</li>
            <li>Use standard HMTL tags for bold and italics.</li>
        </ul>
    </div>
</section>
<?php include '../../view/footer.php'; ?>