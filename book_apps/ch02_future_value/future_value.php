<?php

class FutureValue {
    private $investment;
    private $yearly_rate;
    private $years;

    function __construct() {
        $this->investment = 0;
        $this->yearly_rate = 0;
        $this->years = 0;
    }

    function setInvestment($value) {
        $this->investment = $value;
    }

    function getInvestment() {
        return $this->get_currency_format($this->investment);
    }

    function setYearlyRate($value) {
        $this->yearly_rate = $value;
    }

    function getYearlyRate() {
        return $this->get_percent_format($this->yearly_rate);
    }

    function setYears($value) {
        $this->years = $value;
    }

    function getYears() {
        return $this->years;
    }

    function calculate_future_value() {
        $future_value = $this->investment;
        for ($i = 1; $i <= $this->years; $i++) {
            $future_value =
            $future_value + ($future_value * $this->yearly_rate * .01);
        }
        return $this->get_currency_format($future_value);
    }

    function validate() {
        $investment = $this->investment;
        $interest_rate = $this->yearly_rate;
        $years = $this->years;

        // validate investment
        if ($investment === FALSE ) {
            $error_message = 'Investment must be a valid number.'; 
        } else if ( $investment <= 0 ) {
            $error_message = 'Investment must be greater than zero.'; 
        // validate interest rate
        } else if ( $interest_rate === FALSE )  {
            $error_message = 'Interest rate must be a valid number.'; 
        } else if ( $interest_rate <= 0 ) {
            $error_message = 'Interest rate must be greater than zero.'; 
        // validate years
        } else if ( $years === FALSE ) {
            $error_message = 'Years must be a valid whole number.';
        } else if ( $years <= 0 ) {
            $error_message = 'Years must be greater than zero.';
        } else if ( $years > 30 ) {
            $error_message = 'Years must be less than 31.';
        // set error message to empty string if no invalid entries
        } else {
            $error_message = ''; 
        }

        return $error_message;
    }

    private function get_currency_format($value) {
        return '$' . number_format($value, 2);
    }

    private function get_percent_format($value) {
        return $value.'%';;
    }

}


?>