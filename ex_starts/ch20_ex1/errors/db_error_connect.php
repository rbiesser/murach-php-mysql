<?php include 'view/header.php'; ?>
<section>
    <h1>Database Error</h1>
    <p>An error occurred connecting to the database.</p>
    <p>The database must be installed as described in the appendix.</p>
    <p>MySQL must be running as described in chapter 1.</p>
    <p class="last_paragraph">Error message: <?php echo $error_message; ?></p>
</section>
<?php include 'view/footer.php'; ?>