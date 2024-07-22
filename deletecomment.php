<?php
session_start();
echo "Welcome ".$_SESSION['admin'];
?>

<?php 
include ('connection.php');

$getId = $_GET['id'];
$query = "delete from comment where id = '$getId'";
$data = mysqli_query($conn, $query);

if($data){
    echo "<script>alert('Record Deleted.')</script>";
    ?>
    <meta http-equiv="refresh" content="0; url=http://localhost/crud/comment_settings.php">
    <?php 
}
else{
    echo "Failed to Delete";
}
?>