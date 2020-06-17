<?php
    require('secure_conn.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Guitar Shop</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>My Guitar Shop</h1>
        </header>
        <main>
            <h1>SSL</h1>
            <p>This page contains sensitive data.</p>
            <p><a href="index.php">
                   Continue using a secure connection</a></p>
            <p><a href="http://localhost/book_apps/ch21_ssl/index.php">
                   Return to a regular connection</a></p>
        </main>
    </body>
</html>