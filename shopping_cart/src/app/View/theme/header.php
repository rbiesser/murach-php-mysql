<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Shopping Cart</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css" />
    <link rel="stylesheet" href="/css/main.css">

</head>

<body>
    
<div class="ui container">
<div class="ui secondary pointing menu">
  <a class="<?php echo ($controller == '') ? 'active' : '' ?> item" href="/">
    Home
  </a>
  <a class="<?php echo ($controller == 'shop') ? 'active' : '' ?> item" href="/shop">
    Shop
  </a>
  <!-- <a class="item">
    Friends
  </a> -->
  <div class="right menu">
    <a class="<?php echo ($controller == 'cart') ? 'active' : '' ?> item" href="/cart">
    <i class="cart icon"></i>
    
      Cart
      <div class="hidden floating ui red label">2</div>
    </a>
  </div>
</div>