<?php
// Define an empty array
$numbers = array();

// Populate the array with numbers 1 to 40
for ($i = 1; $i <= 40; $i++) {
  $numbers[] = $i;
}

// Check if factor parameter is set in the URL
if (isset($_GET['factor'])) {
  // Get the factor parameter value from the URL
  $factor = $_GET['factor'];
  
  // Loop through the array and check if each number is a multiple of the factor
  foreach ($numbers as $key => $value) {
    if ($value % $factor == 0) {
      // If the number is a multiple of the factor, replace it with the string "is a multiple of $factor**"
      $numbers[$key] = "$value is a multiple of $factor**";
    }
  }
}

// Output the modified array in the desired format
echo "Modified Array<br>(<br>";
foreach ($numbers as $key => $value) {
  if ($key > 0 && $key % 3 == 0) {
    echo "<br>";
  }
  printf("[%d] => %-20s ", $key, $value);
  
}
echo "<br>)";
?>