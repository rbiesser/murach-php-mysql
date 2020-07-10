<?php
class Customer {
    private 
        $customerID,
        $firstName,
        $lastName,
        $address,
        $city,
        $state,
        $postalCode,
        $countryCode,
        $phone,
        $email,
        $password;

    public function __construct(
        $customerID = null,
        $firstName = null,
        $lastName = null,
        $address = null,
        $city = null,
        $state = null,
        $postalCode = null,
        $countryCode = null,
        $phone = null,
        $email = null,
        $password = null
    ) {
        // just set everything to null and use the setters
        $this->customerID = $customerID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }

    public function save() {
        if ($this->getCustomerID()) {
            // MySQL UPDATE returns 0 rows if there were no changes made to the fields.
            return CustomerDB::update_customer($this);
        }
        else {
            return CustomerDB::add_customer($this);
        }
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function setCustomerID($value) {
        $this->customerID = $value;
    }

    public function getName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($value) {
        $this->firstName = $value;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($value) {
        $this->lastName = $value;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($value) {
        $this->address = $value;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($value) {
        $this->city = $value;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($value) {
        $this->state = $value;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($value) {
        $this->postalCode = $value;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }

    public function setCountryCode($value) {
        $this->countryCode = $value;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

}