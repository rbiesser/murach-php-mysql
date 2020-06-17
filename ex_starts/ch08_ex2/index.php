<?php

//set default values to be used when page first loads
$scores = array();
$scores[0] = 70;
$scores[1] = 80;
$scores[2] = 90;
        
$scores_string = '';
$score_total = 0;
$score_average = 0;
$max_rolls = 0;
$average_rolls = 0;

//take action based on variable in POST array
$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    case 'process_scores':
        $scores = $_POST['scores'];

        // validate the scores
        // TODO: Convert this if statement to a for loop
        if (empty($scores[0]) ||
            empty($scores[1]) ||
            empty($scores[2]) ||
            !is_numeric($scores[0]) ||
            !is_numeric($scores[1]) ||
            !is_numeric($scores[2])) {
                $scores_string = 'You must enter three valid numbers for scores.';
                break;
        }

        // process the scores
        // TODO: Add code that calculates the score total
        $scores_string = '';
        foreach ($scores as $s) {
            $scores_string .= $s . '|';
        }
        $scores_string = substr($scores_string, 0, strlen($scores_string)-1);

        // calculate the average
        $score_average = $score_total / count($scores);
        
        // format the total and average
        $score_total_f = number_format($score_total, 2);
        $score_average_f = number_format($score_average, 2);

        break;
    case 'process_rolls':
        $number_to_roll = filter_input(INPUT_POST, 'number_to_roll', 
                FILTER_VALIDATE_INT);

        $total = 0;
        $count = 0;
        $max_rolls = -INF;

        // TODO: convert this while loop to a for loop
        while ($count < 10000) {
            $rolls = 1;
            while (mt_rand(1, 6) != 6) {
                $rolls++;
            }
            $total += $rolls;
            $count++;
            $max_rolls = max($rolls, $max_rolls);
        }
        $average_rolls = $total / $count;

        break;
}
include 'loop_tester.php';
?>