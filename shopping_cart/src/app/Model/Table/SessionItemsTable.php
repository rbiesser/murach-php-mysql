<?php

class SessionItemsTable
{
    public static function itemExistsInCart($session, $item)
    {
        return self::getItem($session, $item);
    }

    ///
    public static function getItem($session, $item)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM sessionItems 
                    LEFT JOIN sessions on sessionItems.sessionID = sessions.sessionID';
        if ($session->getCustomerID() === null) {
            $query .= ' WHERE sessionItems.sessionID = :sessionID';
        } else {
            $query .= ' WHERE customerID = :customerID';
        }
        $query .= ' AND productID = :productID';
        $statement = $db->prepare($query);
        if ($session->getCustomerID() === null) {
            $statement->bindValue(':sessionID', $session->getSessionID());
        } else {
            $statement->bindValue(':customerID', $session->getCustomerID());
        }
        $statement->bindValue(':productID', $item->getProductID());
        $statement->execute();
        $session = $statement->fetch();
        $statement->closeCursor();

        // var_dump($session);
        // die();
        return $session;
    }

    public static function updateItem($session, $item, $quantity)
    {
        $db = Database::getDB();
        $query = 'UPDATE sessionItems
                    LEFT JOIN sessions on sessionItems.sessionID = sessions.sessionID
                    SET quantity = :quantity';
        if ($session->getCustomerID() === null) {
            $query .= ' WHERE sessionItems.sessionID = :sessionID';
        } else {
            $query .= ' WHERE customerID = :customerID';
        }
        $query .= ' AND productID = :productID';
        try {
            $statement = $db->prepare($query);
            if ($session->getCustomerID() === null) {
                $statement->bindValue(':sessionID', $session->getSessionID());
            } else {
                $statement->bindValue(':customerID', $session->getCustomerID());
            }
            $statement->bindValue(':productID', $item->getProductID());
            $statement->bindValue(':quantity', $quantity);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
    public static function addItem($session, $item, $quantity)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO sessionItems (sessionID, productID, quantity)
                    VALUES (:sessionID, :productID, :quantity)';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':sessionID', $session->getSessionID());
            $statement->bindValue(':productID', $item->getProductID());
            $statement->bindValue(':quantity', $quantity);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function removeItem($session, $item)
    {
        $db = Database::getDB();
        $query = 'DELETE sessionItems FROM sessionItems 
                    LEFT JOIN sessions on sessionItems.sessionID = sessions.sessionID';
        if ($session->getCustomerID() === null) {
            $query .= ' WHERE sessionItems.sessionID = :sessionID';
        } else {
            $query .= ' WHERE customerID = :customerID';
        }
        $query .= ' AND productID = :productID';

        try {
            $statement = $db->prepare($query);
            if ($session->getCustomerID() === null) {
                $statement->bindValue(':sessionID', $session->getSessionID());
            } else {
                $statement->bindValue(':customerID', $session->getCustomerID());
            }
            $statement->bindValue(':productID', $item->getProductID());
            $statement->execute();

        // echo $statement->debugDumpParams();
        // die();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
            die('error');
        }
    }

    public static function removeAllItems($session)
    {
        $db = Database::getDB();
        $query = 'DELETE sessionItems FROM sessionItems 
                    LEFT JOIN sessions on sessionItems.sessionID = sessions.sessionID';

        if ($session->getCustomerID() === null) {
            $query .= ' WHERE sessionItems.sessionID = :sessionID';
        } else {
            $query .= ' WHERE customerID = :customerID';
        }
        try {
            $statement = $db->prepare($query);
            if ($session->getCustomerID() === null) {
                $statement->bindValue(':sessionID', $session->getSessionID());
            } else {
                $statement->bindValue(':customerID', $session->getCustomerID());
            }
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getItemsInCart($session)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM sessionItems 
                    LEFT JOIN sessions on sessionItems.sessionID = sessions.sessionID';

        if ($session->getCustomerID() === null) {
            $query .= ' WHERE sessionItems.sessionID = :sessionID';
        } else {
            $query .= ' WHERE customerID = :customerID';
        }
        try {
            $statement = $db->prepare($query);
            if ($session->getCustomerID() === null) {
                $statement->bindValue(':sessionID', $session->getSessionID());
            } else {
                $statement->bindValue(':customerID', $session->getCustomerID());
            }
            $statement->execute();
            $data = $statement->fetchAll();
            $statement->closeCursor();

            return $data;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
}
