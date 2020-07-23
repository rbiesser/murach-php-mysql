<?php

if ($http_method == 'POST') {

    $addressID = filter_input(INPUT_POST, 'addressID');
    $line1 = filter_input(INPUT_POST, 'line1');
    $line2 = filter_input(INPUT_POST, 'line2');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $zipCode = filter_input(INPUT_POST, 'zipCode');

    // ["shipping"]=> array(5) { ["line1"]=> string(0) "" ["line2"]=> string(0) "" ["city"]=> string(0) "" ["state"]=> string(0) "" ["zipCode"]=> string(0) "" }

    // var_dump($_POST);

    // var_dump($session);

    // die();

    $addressData = array();
    // null means cannot update through this method
    $addressData['addressID'] = $addressID;
    $addressData['customerID'] = null;
    $addressData['line1'] = $line1;
    $addressData['line2'] = $line2;
    $addressData['city'] = $city;
    $addressData['state'] = $state;
    $addressData['zipCode'] = $zipCode;

    $address = new Address($addressData);

    switch ($action) {
        case 'add':
            // session can only update info for currently logged in user
            $address->save($session);

            $_SESSION['message'] = array(
                'type' => 'success',
                'header' => 'Address saved.',
                'body' => ''
            );

            header("Location: /account");
            break;

        case 'delete':
            $customer = $session->getCustomer();

            $customer->deleteAddress($address);

            $_SESSION['message'] = array(
                'type' => 'success',
                'header' => 'Address deleted.',
                'body' => ''
            );

            header("Location: /account");
            break;
    }
} else {

    // pull in form data
    $customer = $session->getCustomer();
    $shipping_address = $customer->getShippingAddress();
    $billing_address = $customer->getBillingAddress();


    require dirname(__DIR__) . '/View/theme/header.php';
    require dirname(__DIR__) . '/View/Address.php';
    require dirname(__DIR__) . '/View/theme/footer.php';
}
