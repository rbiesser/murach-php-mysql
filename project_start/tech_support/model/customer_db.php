<?php
class CustomerDB {
    /**
     * Search by lastname
     * Returns array()
     */
    public static function get_customer_by_lastname($lastname) {
        $db = Database::getDB();
        $query = 'SELECT * FROM customers WHERE upper(lastName) LIKE  upper(?)';
        $statement = $db->prepare($query);
        $statement->bindValue(1, "$lastname%", PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        $customers = array();
        foreach ($result as $row) {
            $customer = new Customer(
                $row['customerID'],
                $row['firstName'],
                $row['lastName'],
                $row['address'],
                $row['city'],
                $row['state'],
                $row['postalCode'],
                $row['countryCode'],
                $row['phone'],
                $row['email'],

                // treat password better
                $row['password']
            );

            $customers[] = $customer;
        }
        return $customers;
    }

    /**
     * Search by id
     * Returns object
     */
    public static function get_customer($customer_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM customers WHERE customerID = :customer_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $customer = new Customer(
            $row['customerID'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['city'],
            $row['state'],
            $row['postalCode'],
            $row['countryCode'],
            $row['phone'],
            $row['email'],

            // treat password better
            $row['password']
        );
        return $customer;
    }

    /**
     * Create Customer
     * Parameter object
     * returns inserted customerID or false
     */
    public static function add_customer($customer) {
        $db = Database::getDB();
        // $password = sha1($email . $password_1);
        $query = '
            INSERT INTO customers (
                firstName,
                lastName,
                address,
                city,
                state,
                postalCode,
                countryCode,
                phone,
                email,
                password
            )
            VALUES (
                :firstName,
                :lastName,
                :address,
                :city,
                :state,
                :postalCode,
                :countryCode,
                :phone,
                :email,
                "sesame"
            )';
        $statement = $db->prepare($query);
        // all fields except customerID
        $statement->bindValue(':firstName', $customer->getFirstName());
        $statement->bindValue(':lastName', $customer->getLastName());
        $statement->bindValue(':address', $customer->getAddress());
        $statement->bindValue(':city', $customer->getCity());
        $statement->bindValue(':state', $customer->getState());
        $statement->bindValue(':postalCode', $customer->getPostalCode());
        $statement->bindValue(':countryCode', $customer->getCountryCode());
        $statement->bindValue(':phone', $customer->getPhone());
        $statement->bindValue(':email', $customer->getEmail());
        // $statement->bindValue(':password', $customer->getPassword());
        $statement->execute();
        $customer_id = $db->lastInsertId();
        $statement->closeCursor();

        // echo $statement->debugDumpParams();

        return $customer_id;
    }

    public static function update_customer($customer) {        
        $db = Database::getDB();
        $query = '
            UPDATE customers
            SET firstName = :firstName,
                lastName = :lastName,
                address = :address,
                city = :city,
                state = :state,
                postalCode = :postalCode,
                countryCode = :countryCode,
                phone = :phone,
                email = :email
            WHERE customerID = :customerID';

        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customer->getCustomerID());
        $statement->bindValue(':firstName', $customer->getFirstName());
        $statement->bindValue(':lastName', $customer->getLastName());
        $statement->bindValue(':address', $customer->getAddress());
        $statement->bindValue(':city', $customer->getCity());
        $statement->bindValue(':state', $customer->getState());
        $statement->bindValue(':postalCode', $customer->getPostalCode());
        $statement->bindValue(':countryCode', $customer->getCountryCode());
        $statement->bindValue(':phone', $customer->getPhone());
        $statement->bindValue(':email', $customer->getEmail());

        $statement->execute();
        
        // echo $statement->debugDumpParams();

        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();

        // only update the password if a new one is given
        // prepare for UI to not display password and so this
        // field will be blank until it needs to change.
        if ($customer->getPassword() !== '') {
            return $valid or CustomerDB::update_password($customer);
        }

        return $valid;
    }

    private static function update_password($customer) {
        $db = Database::getDB();
        $query = '
            UPDATE customers
            SET password = :password
            WHERE customerID = :customerID';

        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customer->getCustomerID());
        // think about the logic of saving password
        $statement->bindValue(':password', $customer->getPassword());

        $statement->execute();
        
        // echo $statement->debugDumpParams();

        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    }

    public static function delete_customer($customer_id) {
        $db = Database::getDB();
        $query = '
            DELETE FROM customers
            WHERE customerID = :customer_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    }

    // function is_valid_customer_email($email) {
    //     global $db;
    //     $query = '
    //         SELECT customerID FROM customers
    //         WHERE emailAddress = :email';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':email', $email);
    //     $statement->execute();
    //     $valid = ($statement->rowCount() == 1);
    //     $statement->closeCursor();
    //     return $valid;
    // }

    // function is_valid_customer_login($email, $password) {
    //     global $db;
    //     $password = sha1($email . $password);
    //     $query = '
    //         SELECT * FROM customers
    //         WHERE emailAddress = :email AND password = :password';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':email', $email);
    //     $statement->bindValue(':password', $password);
    //     $statement->execute();
    //     $valid = ($statement->rowCount() == 1);
    //     $statement->closeCursor();
    //     return $valid;
    // }

    
    // function get_customer_by_email($email) {
    //     global $db;
    //     $query = 'SELECT * FROM customers WHERE emailAddress = :email';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':email', $email);
    //     $statement->execute();
    //     $customer = $statement->fetch();
    //     $statement->closeCursor();
    //     return $customer;
    // }

    // function customer_change_shipping_id($customer_id, $address_id) {
    //     global $db;
    //     $query = 'UPDATE customers SET shipAddressID = :address_id
    //             WHERE customerID = :customer_id';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':address_id', $address_id);
    //     $statement->bindValue(':customer_id', $customer_id);
    //     $statement->execute();
    //     $statement->closeCursor();
    // }

    // function customer_change_billing_id($customer_id, $address_id) {
    //     global $db;
    //     $query = 'UPDATE customers SET billingAddressID = :address_id
    //             WHERE customerID = :customer_id';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':address_id', $address_id);
    //     $statement->bindValue(':customer_id', $customer_id);
    //     $statement->execute();
    //     $statement->closeCursor();
    // }
}
?>