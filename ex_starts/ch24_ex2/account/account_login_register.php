<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <h1>Login</h1>
    <form action="." method="post" id="login_form">
        <input type="hidden" name="action" value="login">
        
        <label>E-Mail:</label>
        <input type="text" name="email"
               value="<?php echo htmlspecialchars($email); ?>" size="30">
        <?php echo $fields->getField('email')->getHTML(); ?><br>

        <label>Password:</label>
        <input type="password" name="password" size="30">
        <?php echo $fields->getField('password')->getHTML(); ?><br>


        <input type="submit" value="Login">
        <?php if (!empty($password_message)) : ?>         
        <span class="error"><?php echo htmlspecialchars($password_message); ?></span><br>
        <?php endif; ?>
    </form>

    <h1>Register</h1>
    <form action="." method="post">
        <input type="hidden" name="action" value="view_register">
        <input type="submit" value="Register">
    </form>
</main>
<?php include '../view/footer.php'; ?>
