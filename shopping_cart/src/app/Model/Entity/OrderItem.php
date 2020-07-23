<?php

class OrderItem
{

    private $itemID;
    private $orderID;
    private $productID;
    private $itemPrice;
    private $discountAmount;
    private $quantity;

    function __construct($item)
    {
        $this->itemID = $item['itemID'];
        $this->orderID = $item['orderID'];
        $this->productID = $item['productID'];
        $this->itemPrice = $item['itemPrice'];
        $this->discountAmount = $item['discountAmount'];
        $this->quantity = $item['quantity'];
    }

    function getItemID()
    {
        return $this->itemID;
    }
    function getOrderID()
    {
        return $this->orderID;
    }
    function getProductID()
    {
        return $this->productID;
    }
    function getItemPrice()
    {
        return $this->itemPrice;
    }
    function getDiscountAmount()
    {
        return $this->discountAmount;
    }
    function getQuantity()
    {
        return $this->quantity;
    }
}
