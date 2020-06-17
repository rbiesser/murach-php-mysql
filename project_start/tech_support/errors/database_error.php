<?php include '../view/header.php'; ?>
<main>
    <h1>Database Error</h1>
    <p>There was an error connecting to the database.</p>
    <p>The database must be installed as described in appendix A.</p>
    <p>The database must be running as described in chapter 1.</p>
    <p>Error message: <?php echo $error_message; ?></p>
</main>
<?php include '../view/footer.php'; ?>