<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RGB to HEX</title>
</head>

<body>
    <h4>RGB to HEX</h4>
    <form method="get" action="#">
        <label for="red">Red:
            <input type="text" id="red" name="red">
        </label>

        <label for="green">Green:
            <input type="text" id="green" name="green">
        </label>

        <label for="blue">Blue:
            <input type="text" id="blue" name="blue">
        </label>

        <input type="submit" />
    </form>

    <?php
	function hexcolor($red, $green, $blue) {
		// Convert the RGB values
		$hex_red = str_pad(dechex($red), 2, '0', STR_PAD_LEFT);
		$hex_green = str_pad(dechex($green), 2, '0', STR_PAD_LEFT);
		$hex_blue = str_pad(dechex($blue), 2, '0', STR_PAD_LEFT);

		// Concatenate the hexadecimal values
		$hex = "#" . $hex_red . $hex_green . $hex_blue;

		return $hex;
	}

	if(isset($_GET['red']) && isset($_GET['green']) && isset($_GET['blue'])) {
		$red = $_GET['red'];
		$green = $_GET['green'];
		$blue = $_GET['blue'];
		
		// Validate the input values
		if(is_numeric($red) && is_numeric($green) && is_numeric($blue) && $red >= 0 && $red <= 255 && $green >= 0 && $green <= 255 && $blue >= 0 && $blue <= 255) {
			// Convert the RGB values to hexadecimal
			$hex = hexcolor($red, $green, $blue);

			// Display the [hexadecimal value](poe://www.poe.com/_api/key_phrase?phrase=hexadecimal%20value&prompt=Tell%20me%20more%20about%20hexadecimal%20value.)
			echo "<p>Hexadecimal: " . $hex . "</p>";
		} else {
			// Display an [error message](poe://www.poe.com/_api/key_phrase?phrase=error%20message&prompt=Tell%20me%20more%20about%20error%20message.) if the input values are invalid
			echo "<p>Error: Invalid input values.</p>";
		}
	}
?>
</body>

</html>