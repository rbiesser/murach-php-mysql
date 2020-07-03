<?php
require dirname(__DIR__) . '/Entity/Product.php';

class ProductsTable {

    function getCountOfItems() {
        return 20;
    }

    function getPaginatedItems($page = 1, $items_per_page = 9) {
        $items = array();

        $start = 1;
        $end = $items_per_page;

        if ($page > 1) {
            $start = (($page - 1) * $items_per_page) + 1;
            $end = $start -1 + $items_per_page;
        }
        // finally, only show actual number
        if ($end > $this->getCountOfItems()) {
            $end = $this->getCountOfItems();
        }

        // for testing
        for ($i = $start; $i < $end +1 ; $i++) {
            array_push($items, new Product($i, 'Product Name ' . $i, 'A Description', 5.99));
        }

        return $items;
    }

    function getFeaturedItems() {
        $items = array();
        $items_count = ($this->getCountOfItems() > 3) ? 3 : $this->getCountOfItems();

        if ($items_count > 0) {
            // for testing
            for ($i = 1; $i <= $items_count; $i++) {
                array_push($items, new Product($i, 'Product Name ' . $i, 'A Description', 5.99));
            }
        }

        return $items;
    }

    function getItemByCode($code) {
        return new Product($code, 'Product Name ' . $code, 'A Description', 5.99);
    }
}