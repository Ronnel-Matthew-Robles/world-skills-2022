<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Number of Days</title>
</head>

<body>
    <h4>Calculate number of days</h4>

    <form action="#">
        <label for="date1">Date 1:
            <input type="date" id="date1">
        </label>

        <label for="date2">Date 2:
            <input type="date" id="date2">
        </label>

        <input type="submit" />
    </form>

    <p>Output:
        <?php

		if (isset($_GET['date1']) && isset($_GET['date2'])) {
			$date1 = strtotime($_GET['date1']);
			$date2 = strtotime($_GET['date2']);

			$diff = abs($date2 - $date1);

			$total = floor($diff/(60*60*24));
			echo $total;
		}
		?>
    </p>
</body>

</html>