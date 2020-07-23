<?php

class AddressTable {
    public static function getAddress($addressId) {
        $db = Database::getDB();
        $query = 'SELECT * FROM addresses WHERE addressId = :addressId';
        $statement = $db->prepare($query);
        $statement->bindValue(':addressId', $addressId);
        $statement->execute();
        $data = $statement->fetch();
        $statement->closeCursor();

        if ($data) {
            return new Address($data);
        } else {
            return null;
        }
    }

    public static function createAddress($session, $address)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO addresses
                    (customerID, line1, line2, city, state, zipCode) 
                    VALUES 
                    (:customerID, :line1, :line2, :city, :state, :zipCode)';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $session->getCustomerID());
            $statement->bindValue(':line1', $address->getLine1());
            $statement->bindValue(':line2', $address->getLine2());
            $statement->bindValue(':city', $address->getCity());
            $statement->bindValue(':state', $address->getState());
            $statement->bindValue(':zipCode', $address->getZipCode());
            $statement->execute();
            $statement->closeCursor();

            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function updateAddress($session, $address) {
        $db = Database::getDB();
        $query = 'UPDATE addresses 
                    SET customerID = :customerID,
                        line1 = :line1,
                        line2 = :line2,
                        city = :city,
                        state = :state,
                        zipCode = :zipCode
                    WHERE
                        addressID = :addressID';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':addressID', $address->getAddressID());
            $statement->bindValue(':customerID', $session->getCustomerID());
            $statement->bindValue(':line1', $address->getLine1());
            $statement->bindValue(':line2', $address->getLine2());
            $statement->bindValue(':city', $address->getCity());
            $statement->bindValue(':state', $address->getState());
            $statement->bindValue(':zipCode', $address->getZipCode());
            $statement->execute();
            $statement->closeCursor();

            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getAddressesByCustomer($customerID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM addresses WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        $addresses = array();
        foreach ($result as $row) {
            $address = new Address($row);
            array_push($addresses, $address);
        }
        return $addresses;
    }
}