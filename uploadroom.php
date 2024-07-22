<?php 
include("connection.php");
?>

<?php
session_start();
$name = $_SESSION['owner'];
if (!isset($_SESSION['owner'])) {
    header('Location: login.php');
    exit();
}else{
    echo "Welcome ".$_SESSION['owner'];
    $query1 = "select O_id from owner where O_fname = '$name'";
    $data1 = mysqli_query($conn, $query1);
    $result = mysqli_fetch_assoc($data1);

    $id = $result['O_id'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Room Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<a href="owner_dashboard.php" class="close-button">×</a>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="title">
        Room Details
    </div>

    <div class="form">
        <div class="input_field" >
            <label>Upload Room Photo</label>
            <input type="file" class="input" name="uploadfile" style="width: 100%;">
        </div>

        <div class="input_field">
            <label>Full Address</label>
            <input id="houseAddress" type="text" class="input" name="houseAddress" placeholder="Kirtipur-10, Kathmandu" required>
        </div>

        <div class="input_field">
            <label>Size of Room</label>
            <input id="rSize" type="text" class="input" name="rSize" placeholder="12 ft x 18 ft" required>
        </div>

        <div class="input_field">
            <label>Price of Room</label>
            <input id="rPrice" type="text" class="input" name="rPrice" placeholder="7000" required>
        </div>

        <div class="input_field">
            <label>House Number</label>
            <input id="hNum" type="text" class="input" name="hNum" required>
        </div>

        <div class="input_field">
            <label>Zip Code</label>
            <input id="zcode" type="text" class="input" name="zcode" placeholder="Enter Zip Code of Your District" required>
        </div>

        <div class="input_field">
            <label>Room Description</label>
            <textarea id="rDesc" class="textarea" name="rDesc" placeholder="This room is located in Kirtipur, Kathmandu. It has facilities like....."></textarea>
        </div>

        <div class="input_field">
            <input type="submit" value="Post" class="btn" name="Post">
        </div>
        

    </div>

</form>
</div>
</body>
</html>

<?php
if(isset($_POST['Post']))
{

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "images/".$filename;
move_uploaded_file($tempname, $folder);

    $houseAddress = $_POST['houseAddress'];
    $rSize = $_POST['rSize'];
    $rPrice = $_POST['rPrice'];
    $hNum = $_POST['hNum'];
    $zcode = $_POST['zcode'];
    $rDesc = $_POST['rDesc'];

    $query = "INSERT INTO room (Image, House_Address, RoomSize, RoomPrice, House_no, Zip_code, Rdescription, O_id) VALUES ('$folder', '$houseAddress', '$rSize', '$rPrice', '$hNum', '$zcode', '$rDesc', '$id')";

        $data = mysqli_query($conn, $query);
        if($data) {
            echo "<script>alert('Data Inserted into Database');</script>";
            echo "<meta http-equiv='refresh' content='0; url=http://localhost/crud/Ownerdisplayroom.php'>";
        } else {
            echo "<script>alert('Failed to insert data');</script>";
        }
}
?>
