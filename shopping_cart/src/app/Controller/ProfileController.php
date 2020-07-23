<?php
if ($http_method == 'POST') {
    
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    // ["shipping"]=> array(5) { ["line1"]=> string(0) "" ["line2"]=> string(0) "" ["city"]=> string(0) "" ["state"]=> string(0) "" ["zipCode"]=> string(0) "" }

    // var_dump($_POST);

    // var_dump($session);

    $customerData = array();
    // null means cannot update through this method
    $customerData['customerID'] = null;
    $customerData['emailAddress'] = $email;
    $customerData['password'] = $password;
    $customerData['firstName'] = $firstName;
    $customerData['lastName'] = $lastName;
    $customerData['shipAddressID'] = null;
    $customerData['billingAddressID'] = null;

    $customer = new Customer($customerData);

    // var_dump($customer);
    // die();
    // session can only update info for currently logged in user
    $customer->save($session->getCustomerID());

    $_SESSION['message'] = array(
        'type' => 'success',
        'header' => 'Account saved.',
        'body' => ''
    );

    header("Location: /account");

    
    // if ($session->login($emailAddress, $password)) {
    //     header("Location: /shop");
    // } else {   
    //     $message = "Invalid user/password combination";
    // }
} else {
    // pull in form data
    $customer = $session->getCustomer();
    $shipping_address = $customer->getShippingAddress();
    $billing_address = $customer->getBillingAddress();


    require dirname(__DIR__) . '/View/theme/header.php';
    require dirname(__DIR__) . '/View/Profile.php';
    require dirname(__DIR__) . '/View/theme/footer.php';

}