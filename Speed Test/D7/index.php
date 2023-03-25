<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Number of Days</title>
</head>

<body>
    <h4>Calculate number of days</h4>
    <form method="get" action="#">
        <label for="date1">Date 1:
            <input type="date" id="date1" name="date1">
        </label>

        <label for="date2">Date 2:
            <input type="date" id="date2" name="date2">
        </label>

        <input type="submit" />
    </form>

    <p>Output:
        <?php
        if(isset($_GET['date1']) && isset($_GET['date2'])) {
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];

            // Convert the dates to [Unix timestamps](poe://www.poe.com/_api/key_phrase?phrase=Unix%20timestamps&prompt=Tell%20me%20more%20about%20Unix%20timestamps.)
            $timestamp1 = strtotime($date1);
            $timestamp2 = strtotime($date2);

            // Calculate the difference in seconds between the two timestamps
            $diff_seconds = abs($timestamp2 - $timestamp1);

            // Calculate the number of days between the two dates
            $diff_days = floor($diff_seconds / (60 * 60 * 24));

            // Display the result
            echo $diff_days . " days";
        }
    ?>
    </p>
</body>

</html>