<?php
require dirname(__DIR__) . '/Entity/Customer.php';

class CustomersTable {

    function getUser() {
        return new Customer;
    }

}