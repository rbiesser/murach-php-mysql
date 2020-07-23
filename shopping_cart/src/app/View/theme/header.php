<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Shopping Cart</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css" />
    <link rel="stylesheet" href="/css/main.css">

</head>

<body>
    <div class="page container">
        <div class="ui top fixed inverted menu">
            <div class="ui container">
                <a class="<?php echo ($controller == '') ? 'active' : '' ?> item" href="/">
                    Home
                </a>
                <a class="<?php echo ($controller == 'shop') ? 'active' : '' ?> item" href="/shop">
                    Shop
                </a>
                <div class="right menu">
                    <?php if ($session->isLoggedIn()) : ?>
                        <a class="<?php echo ($controller == 'account') ? 'active' : '' ?> item" href="/account">
                            My Account
                        </a>
                        <a class="<?php echo ($controller == 'logout') ? 'active' : '' ?> item" href="/account/logout">
                            Logout
                        </a>
                    <?php else : ?>
                        <a class="<?php echo ($controller == 'login') ? 'active' : '' ?> item" href="/account/login">
                            Login
                        </a>
                    <?php endif ?>
                    <a class="<?php echo ($controller == 'cart') ? 'active' : '' ?> item" href="/cart">
                        <i class="cart icon"></i>
                        Cart
                        <?php if ($session->countOfItemsInCart() > 0): ?>
                        <div class="ui red label"><?php echo $session->countOfItemsInCart() ?></div>
                        <?php endif ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="ui main container">