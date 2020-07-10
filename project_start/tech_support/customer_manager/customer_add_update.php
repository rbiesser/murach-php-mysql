<?php include '../view/header.php'; ?>
<main>
    <?php if (isset($message)): ?>
        <!-- the alert popup method -->
        <!-- <script>alert('<?php echo $message ?>')</script> -->
    <div class="alert <?php echo $message_type ?>">
        <?php echo $message ?>
    </div>
    <?php endif ?>

    <form id="add_customer_form" method="post">
        <h2><?php echo ($action == 'customer_add')? 'Add' : 'Update' ?> Customer</h2>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $customer->getFirstName() ?>" />
        <?php echo $fields->getField('first_name')->getHTML(); ?>
        <br />
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $customer->getLastName() ?>" />
        <?php echo $fields->getField('last_name')->getHTML(); ?>
        <br />
        
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $customer->getAddress() ?>" />
        <?php echo $fields->getField('address')->getHTML(); ?>
        <br />
        
        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $customer->getCity() ?>" />
        <?php echo $fields->getField('city')->getHTML(); ?>
        <br />
        
        <!-- there's no states table?? -->
        <label for="state">State:</label>
        <input type="text" name="state" value="<?php echo $customer->getState() ?>" />
        <?php echo $fields->getField('state')->getHTML(); ?>
        <br />
        
        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" value="<?php echo $customer->getPostalCode() ?>" />
        <?php echo $fields->getField('postal_code')->getHTML(); ?>
        <br />
        
        <!-- use countries table -->
        <label for="country_code">Country:</label>
        <select name="country_code" id="country_code">
            <option>Select a country</option>
            <option>--------------------</option>
        <?php foreach ($countries as $country): ?>
            <option value="<?php echo $country->getCountryCode() ?>"<?php echo ($country->getCountryCode() == $customer->getCountryCode()) ? 'selected' : '' ?> ><?php echo $country->getCountryName() ?></option>
        <?php endforeach ?>
        </select>
        <?php echo $fields->getField('country_code')->getHTML(); ?>
        <br />
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $customer->getPhone() ?>" />
        <?php echo $fields->getField('phone')->getHTML(); ?>
        <br />
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $customer->getEmail() ?>" />
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br />

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $customer->getPassword() ?>" />
        <?php echo $fields->getField('password')->getHTML(); ?>
        <br />

        <label>&nbsp;</label>
        <input type="hidden" name="customer_id" value="<?php echo $customer->getCustomerID() ?>" />
        
        <button type="submit" class="btn btn-success"><?php echo ($action == 'customer_add')? 'Add' : 'Update' ?> Customer</button>
    </form>

    <p><a href="?action=customer_search">Search Customers</a></p>
    
</main>
<?php include '../view/footer.php'; ?>