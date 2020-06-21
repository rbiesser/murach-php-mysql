<?php
require dirname(__DIR__) . '/Entity/User.php';

class UsersTable {

    function getUser() {
        return new User;
    }

}