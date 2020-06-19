<?php
    require('future_value.php');
    
    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment',
        FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate',
        FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years',
        FILTER_VALIDATE_INT);
    
    // calculate the future value
    $future_value = new FutureValue();
    $future_value->setInvestment($investment);
    $future_value->setYearlyRate($interest_rate);
    $future_value->setYears($years);
    
    // if an error message exists, go to the index page
    $error_message = $future_value->validate();

    if ($error_message != '') {
        include('index.php');
        exit(); 
    }
    
    // apply currency and percent formatting
    $investment_f = $future_value->getInvestment();
    $yearly_rate_f = $future_value->getYearlyRate();
    $years = $future_value->getYears();
    $future_value_f = $future_value->calculate_future_value();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>
    </main>
</body>
</html>
