<?php
session_start();
if(isset($_SESSION['admin'])){
    echo "Welcome ".$_SESSION['admin'];
} elseif(isset($_SESSION['owner'])){
    echo "Welcome ".$_SESSION['owner'];
}
?>

<?php 
include("connection.php"); 
$getId = $_GET['id'];

$query = "SELECT * FROM room WHERE Room_no = '$getId'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
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
<?php    
if(isset($_SESSION['admin'])){
    ?>
<a href="displaytroom.php" class="close-button">×</a>
<?php
}else{
    ?>
    <a href="Ownerdisplayroom.php" class="close-button">×</a>
    <?php
}
?>
<form action="#" method="POST" enctype="multipart/form-data">
    <div class="title">
        Room Details
    </div>
    <div class="form">

        <div class="input_field">
            <label>Current Image</label>
            <?php if (!empty($result['Image'])) : ?>
                <img src="<?php echo $result['Image']; ?>" alt="Room Image" style="max-width: 200px; margin-top: 10px;">
            <?php endif; ?>
        </div>

        <div class="input_field">
            <label>Upload New Room Photo (if any)</label>
            <input type="file" class="input" name="uploadfile" style="width: 100%;">
        </div>

        <div class="input_field">
            <label>Full Address</label>
            <input id="houseAddress" type="text" value="<?php echo $result['House_Address']; ?>" class="input" name="houseAddress" required>
        </div>

        <div class="input_field">
            <label>Size of Room</label>
            <input id="rSize" type="text" value="<?php echo $result['RoomSize']; ?>" class="input" name="rSize" required>
        </div>

        <div class="input_field">
            <label>Price of Room</label>
            <input id="rPrice" type="text" value="<?php echo $result['RoomPrice']; ?>" class="input" name="rPrice" required>
        </div>

        <div class="input_field">
            <label>House Number</label>
            <input id="hNum" type="text" value="<?php echo $result['House_no']; ?>" class="input" name="hNum" required>
        </div>

        <div class="input_field">
            <label>Zip Code</label>
            <input id="zcode" type="text" value="<?php echo $result['Zip_code']; ?>" class="input" name="zcode" required>
        </div>

        <div class="input_field">
            <label>Room Description</label>
            <textarea id="rDesc" class="textarea" name="rDesc"><?php echo $result['Rdescription']; ?></textarea>
        </div>

        <div class="input_field">
            <input type="submit" value="Update" class="btn" name="update">
        </div>

    </div>

</form>
</div>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/" . $filename;

    if (!empty($filename)) {
        move_uploaded_file($tempname, $folder);
    } else {
        $folder = $result['Image']; // Use the existing image if no new image is uploaded
    }

    $houseAddress = $_POST['houseAddress'];
    $rSize = $_POST['rSize'];
    $rPrice = $_POST['rPrice'];
    $hNum = $_POST['hNum'];
    $zcode = $_POST['zcode'];
    $rDesc = $_POST['rDesc'];

    if ($houseAddress != "" && $rSize != "" && $rPrice != "" && $hNum != "" && $zcode != "" && $rDesc != "") {
        $query = "UPDATE room SET Image='$folder', House_Address='$houseAddress', RoomSize='$rSize', RoomPrice='$rPrice', House_no='$hNum', Zip_code='$zcode', Rdescription='$rDesc' WHERE Room_no='$getId'";
        $data = mysqli_query($conn, $query);

        if ($data) {
            echo "<script>alert('Record Updated.')</script>";
            echo "<meta http-equiv='refresh' content='0; url=http://localhost/crud/displaytroom.php'>";
        } else {
            echo "Failed to Update.";
        }
    } else {
        echo "<script>alert('Please fill the form.')</script>";
    }
}
?>
