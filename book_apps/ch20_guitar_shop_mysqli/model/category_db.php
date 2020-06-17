<?php
function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $result = $db->query($query);
    if ($result == false) {
        display_db_error($db->error);
    }
    $categories = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $category = $result->fetch_assoc();
        $categories[] = $category;
    }
    $result->free();
    return $categories;
}

function get_category($category_id) {
    global $db;
    $category_id_esc = $db->escape_string($category_id);
    $query = "SELECT * FROM categories
              WHERE categoryID = '$category_id_esc'";
    $result = $db->query($query);
    if ($result == false) {
        display_db_error($db->error);
    }
    $category = $result->fetch_assoc();
    $result->free();
    return $category;
}
?>