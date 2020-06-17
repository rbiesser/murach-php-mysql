<?php
require_once('model/fields.php');
require_once('model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('email', 'Must be a valid email address.');
$fields->addField('password', 'Must be at least 6 characters.');
$fields->addField('verify');
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state', 'Use 2 character abbreviation.');
$fields->addField('zip', 'Use 5 or 9 digit ZIP code.');
$fields->addField('phone', 'Use 999-999-9999 format.');
$fields->addField('card_type');
$fields->addField('card_number', 'Enter number with or without dashes.');
$fields->addField('exp_date', 'Use mm/yyyy format.');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'reset';
} else {
    $action = strtolower($action);
}

switch ($action) {
    case 'reset':
        $email = '';
        $password = '';
        $verify = '';
        $firstName = '';
        $lastName = '';
        $address = '';
        $city = '';
        $state = '';
        $zip = '';
        $phone = '';
        $cardType = '';
        $cardNumber = '';
        $cardDigits = '';
        $expDate = '';
        
        include 'view/register.php';
        break;
    case 'register':
        // Copy form values to local variables
        $email = trim(filter_input(INPUT_POST, 'email'));
        $password = filter_input(INPUT_POST, 'password');
        $verify = filter_input(INPUT_POST, 'verify');
        $firstName = trim(filter_input(INPUT_POST, 'first_name'));
        $lastName = trim(filter_input(INPUT_POST, 'last_name'));
        $address = trim(filter_input(INPUT_POST, 'address'));
        $city = trim(filter_input(INPUT_POST, 'city'));
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $phone = filter_input(INPUT_POST, 'phone');
        $cardType = filter_input(INPUT_POST, 'card_type');
        $cardNumber = filter_input(INPUT_POST, 'card_number');
        $cardDigits = preg_replace('/[^[:digit:]]/', '', $cardNumber);
        $expDate = filter_input(INPUT_POST, 'exp_date');

        // Validate form data
        $validate->email('email', $email);
        $validate->password('password', $password);
        $validate->verify('verify', $password, $verify);
        $validate->text('first_name', $firstName);
        $validate->text('last_name', $lastName);
        $validate->text('address', $address);
        $validate->text('city', $city);
        $validate->state('state', $state);
        $validate->zip('zip', $zip);
        $validate->phone('phone', $phone);
        $validate->cardType('card_type', $cardType);
        $validate->cardNumber('card_number', $cardDigits, $cardType);
        $validate->expDate('exp_date', $expDate);

        // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            include 'view/register.php';
        } else {
            include 'view/success.php';
        }
        break;
}
?>