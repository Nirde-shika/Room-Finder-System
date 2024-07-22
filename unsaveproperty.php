<?php
session_start();
if (!isset($_SESSION['renter'])) {
    header('Location: login.php');
    exit();
}

include('connection.php');
$getId = $_GET['id'];

$query = "DELETE FROM save WHERE Room_no = $getId";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "<script>alert('Record Deleted.');</script>";
    echo "<meta http-equiv='refresh' content='0; url=displaySavedProperties.php'>";
} else {
    echo "<script>alert('Failed to Delete');</script>";
}
?>
