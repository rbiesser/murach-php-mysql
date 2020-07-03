<?php
class Product
{
    private $productID;
    private $code;
    private $artwork;
    private $name;
    private $description;
    private $price;
    private $dateAdded;

    function __construct($code, $name, $description, $price, $artwork = '/img/placeholder.png') {
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->artwork = $artwork;
    }

    function getCode() {
        return $this->code;
    }

    function getArtwork() {
        return $this->artwork;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }
}
