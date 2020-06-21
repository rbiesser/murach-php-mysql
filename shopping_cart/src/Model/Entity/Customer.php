<?php
require dirname(__DIR__) . '/Entity/Product.php';

class Customer {
    private $customerID;
    private $emailAddress;
    private $password;
    private $firstName;
    private $lastName;
    private $shipAddressID;
    private $billingAddressID;
    
    private $cart;
    
    function __construct(
                $customerID, 
                $emailAddress, 
                $password,
                $firstName,
                $lastName,
                $shipAddressID,
                $billingAddressID
            ) {
        $this->customerID = $customerID;
        $this->emailAddress = $emailAddress;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->shipAddressID = $shipAddressID;
        $this->billingAddressID = $billingAddressID;

        $this->cart = array();
    }

    function getCart() {
        return $this->cart;
    }
}
