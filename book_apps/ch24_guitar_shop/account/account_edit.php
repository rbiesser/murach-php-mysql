<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <h1>Edit Account</h1>
    <div id="edit_account_form">
    <form action="." method="post">
        <input type="hidden" name="action" value="update_account">
        <label>E-Mail:</label>
        <input type="text" name="email" 
               value="<?php echo htmlspecialchars($email); ?>">
        <?php echo $fields->getField('email')->getHTML(); ?><br>
        
        <label>First Name:</label>
        <input type="text" name="first_name" 
               value="<?php echo htmlspecialchars($first_name); ?>">
        <?php echo $fields->getField('first_name')->getHTML(); ?><br>
        
        <label>Last Name:</label>
        <input type="text" name="last_name" 
               value="<?php echo htmlspecialchars($last_name); ?>">
        <?php echo $fields->getField('last_name')->getHTML(); ?><br>

        <label>New Password:</label>
        <input type="password" name="password_1">&nbsp;&nbsp;
        <?php echo $fields->getField('password_1')->getHTML(); ?>
        <span class="error"><?php echo $password_message; ?></span><br>

        <label>Retype Password:</label>
        <input type="password" name="password_2">
        <?php echo $fields->getField('password_2')->getHTML(); ?><br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Account"><br>
    </form>
    <form action="." method="post">
        <label>&nbsp;</label>
        <input type="submit" value="Cancel">
    </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>
