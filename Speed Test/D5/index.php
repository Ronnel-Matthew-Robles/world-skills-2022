<?php
// Set the path to the image file
$image_path = $_SERVER['DOCUMENT_ROOT'] . '/XX_module_a/D5/media/image1.jpg';

// Load the image file into a PHP image object
$image = imagecreatefromjpeg($image_path);

// Get the dimensions of the image
$image_width = imagesx($image);
$image_height = imagesy($image);

// Create a new image object for the watermark
$watermark = imagecreatetruecolor($image_width, 30);

// Set the color of the watermark to white
$white = imagecolorallocate($watermark, 255, 255, 255);

// Write the "WorldSkills" text to the watermark
$text = 'WorldSkills';
$font_size = 12;
$font_path = $_SERVER['DOCUMENT_ROOT'] . '/path/to/font.ttf';
imagettftext($watermark, $font_size, 0, 5, 20, $white, $font_path, $text);

// Merge the watermark with the original image
imagecopy($image, $watermark, $image_width - imagesx($watermark), $image_height - imagesy($watermark), 0, 0,
imagesx($watermark), imagesy($watermark));

// Set the content type header to indicate that the response is an image
header('Content-Type: image/jpeg');

// Output the modified image to the browser
imagejpeg($image);

// Free up memory by destroying the image objects
imagedestroy($image);
imagedestroy($watermark);
?>