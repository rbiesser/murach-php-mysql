<?php

class CustomersTable
{

    public static function getCustomer($customerId)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM customers WHERE customerId = :customerId';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerId', $customerId);
        $statement->execute();
        $customerData = $statement->fetch();
        $statement->closeCursor();

        return new Customer($customerData);
    }

    public static function getCustomerByEmailAddress($emailAddress)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM customers WHERE emailAddress = :emailAddress';
        $statement = $db->prepare($query);
        $statement->bindValue(':emailAddress', $emailAddress);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();

        return $customer;
    }

    public static function customerExists($emailAddress)
    {
        return self::getCustomerByEmailAddress($emailAddress);
    }

    public static function createCustomer($email, $password)
    {
        $db = Database::getDB();
        $password = sha1($email . $password);
        $query = 'INSERT INTO customers (emailAddress, password) VALUES (:email, :password)';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->execute();
            $statement->closeCursor();

            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function updateCustomer($customerID, $customer)
    {
        $db = Database::getDB();
        $query = 'UPDATE customers
                    SET emailAddress = :email,
                        firstName = :firstName,
                        lastName = :lastName
                    WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $customer->getEmailAddress());
        $statement->bindValue(':firstName', $customer->getFirstName());
        $statement->bindValue(':lastName', $customer->getLastName());
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $statement->closeCursor();

        if (!empty($customer->getPassword())) {
            $password = sha1($customer->getPassword());
            $query = 'UPDATE customers
                        SET password = :password
                        WHERE customerID = :customerID';
            $statement = $db->prepare($query);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':customerID', $customerID);
            $statement->execute();
            $statement->closeCursor();
        }
    }


    public static function is_valid_customer_login($email, $password)
    {
        $db = Database::getDB();
        $password = sha1($email . $password);
        $query = '
            SELECT * FROM customers
            WHERE emailAddress = :email AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    }
}
