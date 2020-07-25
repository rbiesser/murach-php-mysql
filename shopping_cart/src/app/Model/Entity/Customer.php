<?php
// require dirname(__DIR__) . '/Entity/Product.php';

class Customer {
    private $customerID;
    private $emailAddress;
    private $password;
    private $firstName;
    private $lastName;
    private $shipAddressID;
    private $billingAddressID;
    
    function __construct($customer) {
        $this->customerID = $customer['customerID'];
        $this->emailAddress = $customer['emailAddress'];
        $this->password = $customer['password'];
        $this->firstName = $customer['firstName'];
        $this->lastName = $customer['lastName'];

        // get from AddressTable
        $this->shipAddressID = $customer['shipAddressID'];
        $this->billingAddressID = $customer['billingAddressID'];
    }

    function getCustomerID() {
        return $this->customerID;
    }

    function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmailAddress() {
        return $this->emailAddress;
    }

    function getPassword() {
        return $this->password;
    }

    function getShippingAddress() {
        return AddressTable::getAddress($this->shipAddressID);
    }

    function getBillingAddress() {
        return AddressTable::getAddress($this->billingAddressID);
    }

    function getSavedAddresses() {
        return AddressTable::getAddressesByCustomer($this->customerID);
    }

    function deleteAddress($address) {
        return AddressTable::deleteAddress($this, $address);
    }

    // function getOrders() {
    //     return array();
    // }

    function save($customerID) {
        return CustomersTable::updateCustomer($customerID, $this);
    }

}
