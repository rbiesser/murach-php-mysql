<?php
class Product {
    private $code, $name, $version, $releaseDate;

    public function __construct($code, $name, $version, $releaseDate) {
        $this->code = $code;
        $this->name = $name;
        $this->version = $version;
        $this->releaseDate = $releaseDate;
    }

    // public function getCategory() {
    //     return $this->category;
    // }

    // public function setCategory($value) {
    //     $this->category = $value;
    // }

    // public function getID() {
    //     return $this->id;
    // }

    // public function setID($value) {
    //     $this->id = $value;
    // }

    public function getCode() {
        return $this->code;
    }

    public function setCode($value) {
        $this->code = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }
    
    public function getVersion() {
        return $this->version;
    }

    public function setVersion($value) {
        $this->version = $value;
    }
    
    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setReleaseDate($value) {
        $this->releaseDate = $value;
    }

    // public function getPrice() {
    //     return $this->price;
    // }

    // public function getPriceFormatted() {
    //     $formatted_price = number_format($this->price, 2);
    //     return $formatted_price;
    // }

    // public function setPrice($value) {
    //     $this->price = $value;
    // }

    // public function getDiscountPercent() {
    //     $discount_percent = 30;
    //     return $discount_percent;
    // }

    // public function getDiscountAmount() {
    //     $discount_percent = $this->getDiscountPercent() / 100;
    //     $discount_amount = $this->price * $discount_percent;
    //     $discount_amount = round($discount_amount, 2);
    //     $discount_amount = number_format($discount_amount, 2);
    //     return $discount_amount;
    // }

    // public function getDiscountPrice() {
    //     $discount_price = $this->price - $this->getDiscountAmount();
    //     $discount_price = number_format($discount_price, 2);
    //     return $discount_price;
    // }

    // public function getImageFilename() {
    //     $image_filename = $this->code . '.png';
    //     return $image_filename;
    // }

    // public function getImagePath() {
    //     $image_path = '../images/' . $this->getImageFilename();
    //     return $image_path;
    // }

    // public function getImageAltText() {
    //     $image_alt = 'Image: ' . $this->getImageFilename();
    //     return $image_alt;
    // }
}
?>