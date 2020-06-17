<?php include '../view/header.php'; ?>
<main>
    <h2>Billing Address</h2>
    <p><?php echo htmlspecialchars($billing_address['line1']); ?><br>
        <?php if ( strlen($billing_address['line2']) > 0 ) : ?>
            <?php echo htmlspecialchars($billing_address['line2']); ?><br>
        <?php endif; ?>
        <?php echo htmlspecialchars($billing_address['city'] . ', ' . 
              $billing_address['state'] . ' ' .
              $billing_address['zipCode']); ?><br>
        <?php echo htmlspecialchars($billing_address['phone']); ?>
    </p>
    <form action="../account" method="post">
        <input type="hidden" name="action" value="edit_billing">
        <input type="submit" value="Edit Billing Address">
    </form>
    <h2>Payment Information</h2>
    <form action="." method="post" id="payment_form">
        <input type="hidden" name="action" value="process">
        <label>Card Type:</label>
        <select name="card_type">
            <option value="1">MasterCard</option>
            <option value="2">Visa</option>
            <option value="3">Discover</option>
            <option value="4">American Express</option>
        </select>
        <br>

        <label>Card Number:</label>
        <input type="text" name="card_number" 
               value="<?php echo htmlspecialchars($card_number); ?>">
        <span class="error"><?php echo $cc_number_message; ?></span>
        <span>No dashes or spaces.</span>
        <br>

        <label>CVV:</label>
        <input type="text" name="card_cvv" 
               value="<?php echo htmlspecialchars($card_cvv); ?>">
        <span class="error"><?php echo $cc_ccv_message; ?></span>
        <br>

        <label>Expiration:</label>
        <input type="text" name="card_expires" 
               value="<?php echo htmlspecialchars($card_expires); ?>">
        <span class="error"><?php echo $cc_expiration_message; ?></span>
        <span>MM/YYYY</span>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Place Order">&nbsp;&nbsp;
        <span>Click only once.</span>
    </form>
    <form action="../cart" method="post" >
        <input type="submit" value="Cancel Payment Entry">
    </form>
</main>
<?php include '../view/footer.php'; ?>