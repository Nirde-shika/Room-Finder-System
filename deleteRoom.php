<?php
session_start();
echo "Welcome ".$_SESSION['username'];
?>

<?php 
include ('connection.php');

$getId = $_GET['id'];
$query = "delete from room where Room_no = '$getId'";
$data = mysqli_query($conn, $query);

if($data){
    echo "<script>alert('Record Deleted.')</script>";
    ?>
    <meta http-equiv="refresh" content="0; url=http://localhost/crud/displaytroom.php">
    <?php 
}
else{
    echo "Failed to Delete";
}
?>