<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Remove Numbers</title>
</head>

<body>
    <h4>Remove Numbers</h4>
    <form method="post" action="#">
        <label for="input">Input String:</label>
        <input type="text" id="input" name="input">
        <input type="submit" value="Remove Numbers">
    </form>

    <?php
	if(isset($_POST['input'])) {
		$input = $_POST['input'];

		// Remove all numbers from the input string
		$output = preg_replace('/\d+/', '', $input);

		// Display the result
		echo "<p>Output String: " . $output . "</p>";
	}
?>
</body>

</html>