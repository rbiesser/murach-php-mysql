<?php
/**
 * A session item is another name for the session's cart
 */

class SessionItem {
    private $itemID;
    private $sessionID;
    private $productID;
    private $quantity;
    
    function __construct($session, $item) {
        echo 'create session item<br>';
        var_dump($item);
        die();

        $this->sessionID = $session->getSessionID();
        $this->productID = $item->getProductID();
    }

    public function getItemID() {
        return $this->itemID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    // public function updateQuantity($quantity) {
    //     SessionItemsTable::updateItem($this, $quantity);
    // }
    
}
