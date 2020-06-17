
<?php
require_once('../../util/main.php');
require_once('util/secure_conn.php');
require_once('util/valid_admin.php');

require_once('model/admin_db.php');
require_once('model/product_db.php');
require_once('model/category_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {        
        $action = 'list_categories';
    }
}

switch ($action) {
    case 'list_categories':
        $categories = get_categories();

        include('category_list.php');
        break;
    case 'delete_category':
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);

        delete_category($category_id);
        
        header("Location: .");
        break;
    case 'add_category':
        $name = filter_input(INPUT_POST, 'name');

        // Validate inputs
        if (empty($name)) {
            display_error('You must include a name for the category.
                           Please try again.');
        } else {
            $category_id = add_category($name);
        }

        header("Location: .");
        break;
    case 'update_category':
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name');

        // Validate inputs
        if (empty($name)) {
            display_error('You must include a name for the category.
                          Please try again.');
        } else {
            update_category($category_id, $name);
        }

        header("Location: .");
        break;
}

?>