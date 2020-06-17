<?php
    // Parse data
    $category_id = $product['categoryID'];
    $product_code = $product['productCode'];
    $product_name = $product['productName'];
    $description = $product['description'];
    $list_price = $product['listPrice'];
    $discount_percent = $product['discountPercent'];

    // Add HMTL tags to the description
    $description_tags = add_tags($description);

    // Calculate discounts
    $discount_amount = round($list_price * ($discount_percent / 100), 2);
    $unit_price = $list_price - $discount_amount;

    // Format discounts
    $discount_percent_f = number_format($discount_percent, 0);
    $discount_amount_f = number_format($discount_amount, 2);
    $unit_price_f = number_format($unit_price, 2);

    // Get image URL and alternate text
    $image_filename = $product_code . '_m.png';
    $image_path = $app_path . 'images/' . $image_filename;
    $image_alt = 'Image filename: ' . $image_filename;
?>

<h1><?php echo $product_name; ?></h1>
<div id="left_column">
    <p><img src="<?php echo $image_path; ?>"
            alt="<?php echo $image_alt; ?>"></p>
</div>

<div id="right_column">
    <p><b>List Price:</b>
        <?php echo '$' . $list_price; ?></p>
    <p><b>Discount:</b>
        <?php echo $discount_percent_f . '%'; ?></p>
    <p><b>Your Price:</b>
        <?php echo '$' . $unit_price_f; ?>
        (You save <?php echo '$' . $discount_amount_f; ?>)</p>
    <form action="<?php echo $app_path . 'cart' ?>" method="post">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="product_id"
               value="<?php echo $product_id; ?>">
        <b>Quantity:</b>
        <input type="text" name="quantity" value="1" size="2">
        <input type="submit" value="Add to Cart">
    </form>
    <h2 class="no_bottom_margin">Description</h2>
    <?php echo $description_tags; ?>
</div>
