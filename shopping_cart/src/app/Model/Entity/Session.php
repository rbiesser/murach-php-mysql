<?php
/**
 * Sessions are unique visitors to the site based on the PHPSESSID
 */

class Session {
    private $sessionID;
    private $sessionKey;
    private $isLoggedIn;

    private $customerID;
    
    function __construct($sessionKey) {
        // echo 'create new session';

        $this->sessionKey = $sessionKey;

        // might be able to refactor to one db request
        if (SessionsTable::sessionExists($sessionKey)) {
            $sessionData = SessionsTable::getSession($sessionKey);
            
            $this->sessionID = $sessionData['sessionID'];
            $this->customerID = $sessionData['customerID'];
            $this->isLoggedIn = $sessionData['isLoggedIn'];
    
            // updates lastVisitTime since that is the only thing that has changed
            SessionsTable::updateSession($this);
        } else {
            SessionsTable::createSession($sessionKey);
        }
    }

    public function getSessionID() {
        return $this->sessionID;
    }

    public function getSessionKey() {
        return $this->sessionKey;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function login($email, $password) {
        return SessionsTable::login($this, $email, $password);
    }

    public function logout() {
        $this->isLoggedIn = false;
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        return SessionsTable::logout($this->sessionKey);
    }

    public function getCustomer() {
        return CustomersTable::getCustomer($this->customerID);
    }

    function save() {
        return SessionsTable::updateSession($this);
    }
    
    function updateCustomer($newCustomerID) {
        $this->customerID = $newCustomerID;
        return $this->save();
    }
    
    public function getCart() {
        return SessionItemsTable::getItemsInCart($this);
    }

    public function countOfItemsInCart() {
        $cart = $this->getCart();
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    public function addItemToCart($item, $quantity) {
        if (SessionItemsTable::itemExistsInCart($this, $item)) {
            $itemInCart = SessionItemsTable::updateItem($this, $item, $quantity);
        } else {
            $itemInCart = SessionItemsTable::addItem($this, $item, $quantity);
        }
    }

    public function removeItemFromCart($item) {
        SessionItemsTable::removeItem($this, $item);
    }

    public function emptyCart() {
        SessionItemsTable::removeAllItems($this);
    }

    public function updateItemInCart($item, $quantity) {
        SessionItemsTable::updateItem($this, $item, $quantity);
    }

}
