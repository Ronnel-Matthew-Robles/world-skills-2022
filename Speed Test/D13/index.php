<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert code 64 to image</title>
</head>

<body>


    <form action="" method="POST">
        <textarea name="code" placeholder="CODE64"></textarea>
        <input type="submit" value="Convert">
    </form>

    <?php
if(isset($_POST['code'])){
    $base64_code = $_POST['code'];
    $image_data = base64_decode($base64_code);
    $image_resource = imagecreatefromstring($image_data);
    $image_path = 'converted_image.png';
    imagepng($image_resource, $image_path);
    imagedestroy($image_resource);
    echo '<img src="'.$image_path.'">';
}
?>

</body>

</html>