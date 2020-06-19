<?php

function calculate_future_value($investment, $yearly_rate, $years) {
	$future_value = $investment;
	for ($i = 1; $i <= $years; $i++) {
		$future_value =
			$future_value + ($future_value * $yearly_rate * .01);
	}
	return $future_value;
}

function get_currency_format($value) {
	return '$' . number_format($value, 2);
}

function get_percent_format($value) {
	return $value;
}

?>