<?php
require_once('../../util/main.php');
require_once('util/secure_conn.php');
require_once('model/admin_db.php');
require_once('model/fields.php');
require_once('model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if (admin_count() == 0) {
    if ($action != 'create') {
        $action = 'view_account';
    }
} elseif (isset($_SESSION['admin'])) {
    if ($action == null) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == null ) {
            $action = 'view_account';            
        }
    }
} elseif ($action == 'login') {
    $action = 'login';
} else {
    $action = 'view_login';
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Add Account page and other pages
$fields->addField('email', 'Must be valid email.');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('first_name');
$fields->addField('last_name');

// for the Login page
$fields->addField('password');

switch ($action) {
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';
        
        include 'account_login.php';
        break;
    case 'login':
        // Get username/password
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/account_login.php';
            break;
        }
        
        // Check database - if valid username/password, log in
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['admin'] = get_admin_by_email($email);
        } else {
            $password_message = 'Login failed. Invalid email or password.';
            include 'admin/account/account_login.php';
            break;
        }

        // Display Admin Menu page
        redirect('..');
        break;
    case 'view_account':
        // Get all accounts from database
        $admins = get_all_admins();

        // Set up variables for add form
        $email = '';
        $first_name = '';
        $last_name = '';
        if (!isset($email_message)) { 
            $email_message = '';             
        }
        if (!isset($password_message)) { 
            $password_message = '';             
        }

        // View admin accounts
        include 'account_view.php';
        break;
    case 'create':
        // Get admin user data
        $email = filter_input(INPUT_POST, 'email');
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');

        $admins = get_all_admins();
        $email_message = '';             
        $password_message = '';             

        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);        
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);     
        
        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/account_view.php';
            break;
        }
        
        if (is_valid_admin_email($email)) {
            $email_message = 'This email is already in use.';
            include 'admin/account/account_view.php';
            break;
        }
        
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'admin/account/account_view.php';
            break;
        }

        // Add admin user
        $admin_id = add_admin($email, $first_name, $last_name,
                                 $password_1);

        // Set admin user in session
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = get_admin($admin_id);
        }

        redirect('.');
        break;
    case 'view_edit':
        // Get admin user data
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        $admin = get_admin($admin_id);
        $first_name = $admin['firstName'];
        $last_name = $admin['lastName'];
        $email = $admin['emailAddress'];
        $password_message = '';

        // Display Edit page
        include 'account_edit.php';
        break;
    case 'update':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, 'email');
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        
        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);        
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);     
        
        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/account_edit.php';
            break;
        }
        
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'admin/account/account_edit.php';
            break;
        }
        
        update_admin($admin_id, $email, $first_name, $last_name, 
                $password_1, $password_2);
       
        if ($admin_id == $_SESSION['admin']['adminID']) {
            $_SESSION['admin'] = get_admin($admin_id);
        }
        redirect($app_path . 'admin/account/.?action=view_account');
        break;
    case 'view_delete_confirm':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        if ($admin_id == $_SESSION['admin']['adminID']) {
            display_error('You cannot delete your own account.');
        }
        $admin = get_admin($admin_id);
        $first_name = $admin['firstName'];
        $last_name = $admin['lastName'];
        $email = $admin['emailAddress'];
        include 'account_delete.php';
        break;
    case 'delete':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        delete_admin($admin_id);
        redirect($app_path . 'admin/account');
        break;
    case 'logout':
        unset($_SESSION['admin']);
        redirect($app_path . 'admin/account');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        break;
}
?>