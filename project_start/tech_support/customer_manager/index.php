<?php
error_reporting(E_ALL);
require('../model/database.php');
// start with book_apps/ch24_guitar_shop as an example except the database structure
// is different and customers do not register themselves. I'm just matching the app
// structure in tech_support.

// require_once('../util/main.php');
// require_once('util/secure_conn.php');

require_once('../model/customer.php');
require_once('../model/customer_db.php');
require_once('../model/country_db.php');
// tech_support doesn't maintain a separate addresses table
// require_once('model/address_db.php');
// require_once('model/order_db.php');
// require_once('model/product_db.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'customer_search';
        // $action = 'view_login';
        // if (isset($_SESSION['user'])) {
        //     $action = 'view_account';
        // }
    }
}

// this fields/validate pattern from Murach is pretty interesting

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Registration page and other pages
$fields->addField('customer_id');
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state');
$fields->addField('postal_code');
$fields->addField('country_code');
$fields->addField('phone');
$fields->addField('email', 'Must be valid email.');

// for the Login page
$fields->addField('password');

// $lastname = filter_input(INPUT_POST, 'lastname');
// $message = null;

// try out switch action branching instead of if/else method of product_manager
switch ($action) {
    case 'customer_search':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lastname = filter_input(INPUT_POST, 'lastname');
            $customers = isset($lastname) ? CustomerDB::get_customer_by_lastname($lastname) : null;

            if (empty($customers)) {
                $message = "Customer not found.";
            } 
        }

        include 'customer_search.php';
        break;

    case 'customer_add':
    case 'customer_update':
        $countries = CountryDB::get_countries();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Store user data in local variables
            $customer_id = filter_input(INPUT_POST, 'customer_id');
            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');
            $address = filter_input(INPUT_POST, 'address');
            $city = filter_input(INPUT_POST, 'city');
            $state = filter_input(INPUT_POST, 'state');
            $postal_code = filter_input(INPUT_POST, 'postal_code');
            $country_code = filter_input(INPUT_POST, 'country_code');
            $phone = filter_input(INPUT_POST, 'phone');
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

            // Validate user data 
            // $validate->text('customer_id', $customer_id);
            $validate->text('first_name', $first_name);
            $validate->text('last_name', $last_name);
            $validate->text('address', $address);
            $validate->text('city', $city);
            $validate->text('state', $state);
            $validate->text('postal_code', $postal_code);
            $validate->text('country_code', $country_code);
            $validate->phone('phone', $phone);
            $validate->email('email', $email);
            $validate->text('password', $password, false);
        
            $customer = new Customer(
                $customer_id,
                $first_name,
                $last_name,
                $address,
                $city,
                $state,
                $postal_code,
                $country_code,
                $phone,
                $email,
                $password
            );

            // If validation errors, redisplay update page and exit controller
            if ($fields->hasErrors()) {
                include 'customer_add_update.php';
                break;
            }

            if ($customer->save()) {
                $message = "Customer has been updated.";
                $message_type = "alert-info";
            }
            else {
                $message = "No changes were made.";
                $message_type = "alert-info";
            }

            include 'customer_add_update.php';
            break;

        }

        $customer_id = filter_input(INPUT_GET, 'customer_id');

        $customer = isset($customer_id) ? CustomerDB::get_customer($customer_id) : new Customer();

        if (empty($customer)) {
            $message = "Customer not found.";
            // give the user option to create new user.
            $action = 'customer_add';
        }

        include 'customer_add_update.php';
        break;

    case 'customer_delete':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customer_id = filter_input(INPUT_POST, 'customer_id');
                $result = isset($customer_id) ? CustomerDB::delete_customer($customer_id) : null;

                if ($result) {
                    $message = "Customer deleted.";
                    $message_type = "alert-info";
                } else {
                    $message = "Customer not found.";
                    $message_type = "alert-danger";
                }
            }
        include 'customer_search.php';
        break;

    default:
        // display_error("Unknown account action: " . $action);
        // break;
        $error = "Unknown account action: " . $action;
        include '../errors/error.php';
}
?>