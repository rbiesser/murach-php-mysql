<?php
// if (isset($_SESSION['message'])) {
//     $message = $_SESSION['message'];
//     unset($_SESSION['message']);
// }

switch ($action) {
    case 'register':
        require dirname(__DIR__) . '/Controller/RegisterController.php';
        break;
    case 'login':
    case 'logout':
        require dirname(__DIR__) . '/Controller/LoginController.php';
        break;
    case 'edit':
        require dirname(__DIR__) . '/Controller/ProfileController.php';
        break;
    default:
        // $message = "Invalid user/password combination";
        
        $customer = $session->getCustomer();
        // $shipping_address = $customer->getShippingAddress();
        // $billing_address = $customer->getBillingAddress();
        $addresses = $customer->getSavedAddresses();
        $orders = $customer->getOrders();


        require dirname(__DIR__) . '/View/theme/header.php';
        require dirname(__DIR__) . '/View/Account.php';
        require dirname(__DIR__) . '/View/theme/footer.php';

}

