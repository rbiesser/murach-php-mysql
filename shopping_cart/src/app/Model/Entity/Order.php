<?php

class Order
{
    private $orderID;
    private $customerID;
    private $orderDate;
    private $shipAmount;
    private $taxAmount;
    private $shipDate;

    // addresses should not be able to be deleted if they have been used
    // set a disabled flag
    private $shipAddressID;
    private $billingAddressID;

    // I don't like that it's storing cc data
    // figure out what is needed from provider
    private $cardType;
    private $cardNumber;
    private $cardExpires;


    function __construct($order)
    {
        $this->orderID = $order['orderID'];
        $this->customerID = $order['customerID'];
        $this->orderDate = $order['orderDate'];
        $this->shipAmount = $order['shipAmount'];
        $this->taxAmount = $order['taxAmount'];
        $this->shipDate = $order['shipDate'];
        $this->shipAddressID = $order['shipAddressID'];
        $this->billingAddressID = $order['billingAddressID'];
    }

    function getOrderID()
    {
        return $this->orderID;
    }
    function getCustomerID()
    {
        return $this->customerID;
    }
    function getOrderDate()
    {
        return $this->orderDate;
    }
    function getShipAmount()
    {
        return $this->shipAmount;
    }
    function getTaxAmount()
    {
        return $this->taxAmount;
    }
    function getShipDate()
    {
        return $this->shipDate;
    }
    function getShipAddressID()
    {
        return $this->shipAddressID;
    }
    function getBillingAddressID()
    {
        return $this->billingAddressID;
    }
}
