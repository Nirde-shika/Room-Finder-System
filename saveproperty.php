<?php
session_start();
include("connection.php");

if (!isset($_SESSION['renter'])) {
    header('Location: login.php');
    exit();
}

$name = $_SESSION['renter'];
$query1 = "SELECT R_id FROM renter WHERE R_fname = '$name'";
$data1 = mysqli_query($conn, $query1);
$result1 = mysqli_fetch_assoc($data1);
$renter1 = $result1['R_id'];
$getId = $_GET['id'];

// Check if the property is already saved by the renter
$checkQuery = "SELECT * FROM save WHERE R_id = $renter1 AND Room_no = $getId";
$checkData = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkData) == 0) {
    // Insert the property into the save table
    $query = "INSERT INTO save (R_id, Room_no) VALUES ($renter1, $getId)";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>alert('Property Saved.'); window.location.href='rentersearch.php';</script>";
    } else {
        echo "<script>alert('Failed to Save Property.'); window.location.href='rentersearch.php';</script>";
    }
} else {
    echo "<script>alert('Property is already saved.'); window.location.href='rentersearch.php';</script>";
}