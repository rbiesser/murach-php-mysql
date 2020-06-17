<?php include 'header.php'; ?>
<main>
    <form action="." method="post" >
    <fieldset>
        <legend>Account Information</legend>
        
        <label>E-Mail:</label>
        <input type="text" name="email" 
               value="<?php echo htmlspecialchars($email);?>">
        <?php echo $fields->getField('email')->getHTML(); ?><br>

        <label>Password:</label>
        <input type="password" name="password" 
               value="<?php echo htmlspecialchars($password);?>">
        <?php echo $fields->getField('password')->getHTML(); ?><br>

        <label>Verify Password:</label>
        <input type="password" name="verify" 
               value="<?php echo htmlspecialchars($verify);?>">
        <?php echo $fields->getField('verify')->getHTML(); ?><br>
    </fieldset>
    <fieldset>
        <legend>Contact Information</legend>

        <label>First Name:</label>
        <input type="text" name="first_name" 
               value="<?php echo htmlspecialchars($firstName);?>">
        <?php echo $fields->getField('first_name')->getHTML(); ?><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" 
               value="<?php echo htmlspecialchars($lastName);?>">
        <?php echo $fields->getField('last_name')->getHTML(); ?><br>

        <label>Address:</label>
        <input type="text" name="address" 
               value="<?php echo htmlspecialchars($address);?>">
        <?php echo $fields->getField('address')->getHTML(); ?><br>

        <label>City:</label>
        <input type="text" name="city" 
               value="<?php echo htmlspecialchars($city); ?>">
        <?php echo $fields->getField('city')->getHTML(); ?><br>

        <label>State:</label>
        <input type="text" name="state" maxlength="2"
               value="<?php echo htmlspecialchars($state); ?>">
        <?php echo $fields->getField('state')->getHTML(); ?><br>

        <label>ZIP Code:</label>
        <input type="text" name="zip" 
               value="<?php echo htmlspecialchars($zip); ?>">
        <?php echo $fields->getField('zip')->getHTML(); ?><br>

        <label>Phone Number:</label>
        <input type="text" name="phone" 
               value="<?php echo htmlspecialchars($phone); ?>">
        <?php echo $fields->getField('phone')->getHTML(); ?><br>
    </fieldset>
    <fieldset>
        <legend>Payment Information</legend>

        <label>Card Type:</label>
        <select name="card_type">
            <option value="">Select One:</option>
            <option value="m"
              <?php if ($cardType=='m') { echo 'selected'; } ?>
            >MasterCard</option>
            <option value="v"
              <?php if ($cardType=='v') { echo 'selected'; } ?>
            >Visa</option>
            <option value="a"
              <?php if ($cardType=='a') { echo 'selected'; } ?>
            >American Express</option>
            <option value="d"
              <?php if ($cardType=='d') { echo 'selected'; } ?>
            >Discover</option>
        </select>
        <?php echo $fields->getField('card_type')->getHTML(); ?><br>

        <label>Card Number:</label>
        <input type="text" name="card_number" 
               value="<?php echo htmlspecialchars($cardNumber); ?>">
        <?php echo $fields->getField('card_number')->getHTML(); ?><br>

        <label>Expiration Date:</label>
        <input type="text" name="exp_date" 
               value="<?php echo htmlspecialchars($expDate); ?>">
        <?php echo $fields->getField('exp_date')->getHTML(); ?><br>
    </fieldset>
    <fieldset>
        <legend>Submit Registration</legend>

        <label>&nbsp;</label>
        <input type="submit" name="action" value="Register">
        <input type="submit" name="action" value="Reset" ><br>
    </fieldset>
    </form>
</main>
<?php include 'footer.php'; ?>        