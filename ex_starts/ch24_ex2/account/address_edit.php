<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <h1><?php echo $heading; ?></h1>
    <div id="edit_address_form">
    <form action="." method="post">
        <input type="hidden" name="action" value="update_address">
        <input type="hidden" name="address_type" value="<?php echo $address_type ?>">
        <label>Address:</label>
        <input type="text" name="line1" 
               value="<?php echo htmlspecialchars($line1); ?>">
        <?php echo $fields->getField('line1')->getHTML(); ?><br>
        
        <label>Line 2:</label>
        <input type="text" name="line2" 
               value="<?php echo htmlspecialchars($line2); ?>">
        <?php echo $fields->getField('line2')->getHTML(); ?><br>
        
        <label>City:</label>
        <input type="text" name="city" 
               value="<?php echo htmlspecialchars($city); ?>">
        <?php echo $fields->getField('city')->getHTML(); ?><br>
        
        <label>State:</label>
        <input type="text" name="state" 
               value="<?php echo htmlspecialchars($state); ?>">
        <?php echo $fields->getField('state')->getHTML(); ?><br>
        
        <label>Zip Code:</label>
        <input type="text" name="zip" 
               value="<?php echo htmlspecialchars($zip); ?>">
        <?php echo $fields->getField('zip')->getHTML(); ?><br>
        
        <label>Phone:</label>
        <input type="text" name="phone" 
               value="<?php echo htmlspecialchars($phone); ?>">
        <?php echo $fields->getField('phone')->getHTML(); ?><br>
        
        <label>&nbsp;</label>
        <input type="submit" 
               value="<?php echo htmlspecialchars($heading); ?>">
        <br>
    </form>
    <form action="." method="post">
        <label>&nbsp;</label>
        <input type="submit" value="Cancel">
    </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>
