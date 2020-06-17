<?php
//set default values
$number1 = 78;
$number2 = -105.33;
$number3 = 0.0049;
$message = 'Enter some numbers and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    case 'process_data':
        $number1 = filter_input(INPUT_POST, 'number1');
        $number2 = filter_input(INPUT_POST, 'number2');
        $number3 = filter_input(INPUT_POST, 'number3');

        // make sure the user enters three numbers

        // make sure the numbers are valid

        // get the ceiling and floor for $number2

        // round $number3 to 3 decimal places

        // get the max and min values of all three numbers

        // generate a random integer between 1 and 100

        // format the message
        $message = "This page is under construction.\n" .
                   "Please write the code that process the data.";
        //$message =
        //    "Number 1: $number1\n" .
        //    "Number 2: $number2\n" .
        //    "Number 3: $number3\n" .
        //    "\n" .
        //    "Number 2 ceiling: $number2_ceil\n" .
        //    "Number 2 floor: $number2_floor\n" .
        //    "Number 3 rounded: $number3_rounded\n" .
        //    "\n" .
        //    "Min: $min\n" .
        //    "Max: $max\n" .
        //    "\n" .
        //    "Random: $random\n";

        break;
}
include 'number_tester.php';
?>