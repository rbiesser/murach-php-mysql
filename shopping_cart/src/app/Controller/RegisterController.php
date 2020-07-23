<?php


// require_once dirname(__DIR__) . '/Model/Table/CustomersTable.php';
// require_once dirname(__DIR__) . '/Model/Table/SessionsTable.php';

// $CustomersDB = new CustomersTable($db);
// $SessionsDB = new SessionsTable($db);

if($session->isLoggedIn()) {
    $_SESSION['message'] = "You are already logged in";
    header("Location: /profile");
}

if ($http_method == 'POST') {

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (isset($email) && isset($password)) {

        if (CustomersTable::customerExists($email)) {
            $message = 'An account with this Email already exists.';
        } else {
            $newCustomerID = CustomersTable::createCustomer($email, $password);
            $session->updateCustomer($newCustomerID);
            $session->login($email, $password);
    
            $_SESSION['message'] = "Created new account";
            header("Location: /account/edit");
        }
    }

    
}

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Register.php';
require dirname(__DIR__) . '/View/theme/footer.php';