<?php
function is_present($value) {
    if (isset($value) && strlen($value) > 0) {
        return true;
    } else {
        return false;
    }
}

function is_valid_number($value, $min = NULL,
        $max = NULL, $required = true) {
    if ($required && !is_present($value)) { return false; }
    if (!is_numeric($value)) { return false; }
    if (isset($min) && $value < $min) {
        return false;
    }
    if (isset($max) && $value > $max) {
        return false;
    }
    return true;
}

function is_valid_card_type($card_type) {
    if (!is_int($card_type)) { return false; }
    if ( $card_type < 1 || $card_type > 4 ) { return false; }
    return true;
}

function is_valid_card_number($card_number, $card_type) {
    switch ($card_type) {
        case 4:
            $pattern = '/^\d{15}$/';
            break;
        default:
            $pattern = '/^\d{16}$/';
            break;
    }
    return preg_match($pattern, $card_number);
}

function is_valid_card_cvv($card_cvv, $card_type) {
    switch ($card_type) {
        case 4:
            $pattern = '/^\d{4}$/';
            break;
        default:
            $pattern = '/^\d{3}$/';
            break;
    }
    return preg_match($pattern, $card_cvv);
}

function is_valid_card_expires($card_expires) {
    $pattern = '/^\d{1,2}\/\d{4}$/';
    if (!preg_match($pattern, $card_expires)) { return false; }
    $date_parts = explode('/', $card_expires);
    $now = new DateTime();
    $expires = new DateTime();
    $expires->setDate($date_parts[1], $date_parts[0], 1);
    $expires->add(new DateInterval("P1M"));
    $expires->sub(new DateInterval("P1D"));
    $expires->setTime(23,59,59);

    return ($now < $expires);
}
?>