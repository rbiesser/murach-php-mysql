<?php
class Item
{
    private $code;
    private $artwork;
    private $description;
    private $price;

    function __construct($code, $description, $price, $artwork = '/img/placeholder.png') {
        $this->code = $code;
        $this->artwork = $artwork;
        $this->description = $description;
        $this->price = $price;
    }

    function getCode() {
        return $this->code;
    }

    function getArtwork() {
        return $this->artwork;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }
}
