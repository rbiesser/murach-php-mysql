<?php
function is_valid_admin_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = 'SELECT * FROM administrators
              WHERE emailAddress = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function admin_count() {
    global $db;
    $query = 'SELECT count(*) AS adminCount FROM administrators';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['adminCount'];
}

function get_all_admins() {
    global $db;
    $query = 'SELECT * FROM administrators ORDER BY lastName, firstName';
    $statement = $db->prepare($query);
    $statement->execute();
    $admins = $statement->fetchAll();
    $statement->closeCursor();
    return $admins;
}

function get_admin ($admin_id) {
    global $db;
    $query = 'SELECT * FROM administrators WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}

function get_admin_by_email ($email) {
    global $db;
    $query = 'SELECT * FROM administrators WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}

function is_valid_admin_email($email) {
    global $db;
    $query = '
        SELECT * FROM administrators
        WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function add_admin($email, $first_name, $last_name, $password_1) {
    global $db;
    $password = sha1($email . $password_1);
    $query = '
        INSERT INTO administrators (emailAddress, password, firstName, lastName)
        VALUES (:email, :password, :first_name, :last_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->execute();
    $admin_id = $db->lastInsertId();
    $statement->closeCursor();
    return $admin_id;
}

function update_admin($admin_id, $email, $first_name, $last_name,
                      $password_1, $password_2) {
    global $db;
    $query = '
        UPDATE administrators
        SET emailAddress = :email,
            firstName = :first_name,
            lastName = :last_name
        WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1) && !empty ($password_2)) {
        if ($password_1 !== $password_2) {
            display_error('Passwords do not match.');
        } elseif (strlen($password_1) < 6) {
            display_error('Password must be at least six characters.');
        }
        $password = sha1($email . $password_1);
        $query = '
            UPDATE administrators
            SET password = :password
            WHERE adminID = :admin_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

function delete_admin($admin_id) {
    global $db;
    $query = 'DELETE FROM administrators WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $statement->closeCursor();
}
?>