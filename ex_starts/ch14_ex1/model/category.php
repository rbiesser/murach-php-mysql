<?php
class Category {
    private $id;
    private $name;

    public function __construct() {
        $this->id = 1;
        $this->name = 'name';
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }
}
?>