<?php
// require dirname(__DIR__) . '/Entity/Product.php';

class Address {
    private $addressID;
    private $customerID;
    private $line1;
    private $line2;
    private $city;
    private $state;
    private $zipCode;
    private $phone;
    private $disabled;

    function __construct($address) {
        $this->addressID = $address['addressID'];
        $this->customerID = $address['customerID'];
        $this->line1 = $address['line1'];
        $this->line2 = $address['line2'];
        $this->city = $address['city'];
        $this->state = $address['state'];
        $this->zipCode = $address['zipCode'];
        // $this->phone = $address['phone'];
        // $this->disabled = $address['disabled'];
    }

    function getOneLiner() {

        $address = '';
        $address .= (isset($this->line1)) ? $this->line1 : '';
        $address .= isset($this->line2) ? ' ' . $this->line2 : '';
        $address .= isset($this->city) ? ', ' . $this->city : '';
        $address .= isset($this->state) ? ', ' . $this->state : '';
        $address .= isset($this->zipCode) ? ' ' . $this->zipCode : '';

        return $address;
    }

    function getLine1() {
        return $this->line1;
    }

    function getLine2() {
        return $this->line2;
    }

    function getCity() {
        return $this->city;
    }

    function getState() {
        return $this->state;
    }

    function getZipCode() {
        return $this->zipCode;
    }

    function getPhone() {
        return $this->phone;
    }

    function isDisabled() {
        return $this->disabled;
    }

    function save($session) {
        if (isset($this->addressID)) {
            return AddressTable::updateAddress($session, $this);
        } else {
            return AddressTable::createAddress($session, $this);
        }
    }
}