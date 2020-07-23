<?php

class SessionsTable
{

    public static function createSession($sessionKey)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO sessions (sessionKey) VALUES (:sessionKey)';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':sessionKey', $sessionKey);
            $statement->execute();
            $statement->closeCursor();

            // Get the last product ID that was automatically generated
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    // only the customerId should be updated
    // use login/logout
    // sessionKey should not be changed once created
    public static function updateSession($session)
    {
        // var_dump($session);
        // die();
        $db = Database::getDB();
        $query = 'UPDATE sessions 
                    SET customerID = :customerId,
                        lastVisitTime = NOW() 
                    WHERE sessionKey = :sessionKey';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':customerId', $session->getCustomerId());
            $statement->bindValue(':sessionKey', $session->getSessionKey());
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getSession($sessionKey)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM sessions WHERE sessionKey = :sessionKey';
        $statement = $db->prepare($query);
        $statement->bindValue(':sessionKey', $sessionKey);
        $statement->execute();
        $session = $statement->fetch();
        $statement->closeCursor();

        // var_dump($session);
        // die();
        return $session;
    }

    public static function sessionExists($sessionKey)
    {
        return self::getSession($sessionKey);
    }

    public static function login($session, $email, $password)
    {
        if (CustomersTable::is_valid_customer_login($email, $password)) {
            $customer = CustomersTable::getCustomerByEmailAddress($email);
            $db = Database::getDB();
            $query = 'UPDATE sessions 
                        SET customerID = :customerId,
                            isLoggedIn = true 
                        WHERE sessionKey = :sessionKey';
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':customerId', $customer['customerID']);
                $statement->bindValue(':sessionKey', $session->getSessionKey());
                $statement->execute();
                $statement->closeCursor();
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
            }

            return true;
        } else {
            return false;
        }
    }

    public static function logout($sessionKey)
    {
        $db = Database::getDB();
        $query = 'UPDATE sessions SET isLoggedIn = false 
                WHERE sessionKey = :sessionKey';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':sessionKey', $sessionKey);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
}
