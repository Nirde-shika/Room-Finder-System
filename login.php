<?php
session_start();
?>

<?php 
include("connection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Login Form</title>
</head>
<body>
<div class="container">
<a href="ui.php" class="close-button">×</a>
<form id="loginForm" action="#" method="POST">

    <div class="title">
        Login
    </div>

    <div class="form">
        <div class="input_field">
            <label>Email</label>
            <input id="email" type="email" class="input" name="email">
        </div>

        <div class="input_field">
            <label>Password</label>
            <input id="password" type="password" class="input" name="password">
        </div>

        <div class="input_field">
            <input type="submit" value="Login" class="btn" name="login">
        </div>

        <div class="signup">Not Registered Yet? <a href="B4register.php" class="link">Register Here</a> </div>
    </div>
</form> 
</div>
</body>
</html>

<?php
if(isset($_POST['login']))
{
    $pwd = $_POST['password'];
    $email = $_POST['email'];

    $sql = "
    SELECT 'owner' as user_type, O_id, O_fname, O_lname, O_email, O_password FROM owner WHERE O_email='$email' and O_password='$pwd'
    UNION
    SELECT 'renter' as user_type, R_id, R_fname, R_lname, R_email, R_password FROM renter WHERE R_email='$email' and  R_password='$pwd'
    union
    select 'admin' as user_type, id, firstname, lastname, apassword, email from admin where email='$email' and apassword='$pwd';";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
        
        if ($row['user_type'] == 'owner') {
            $sql2 = "select O_fname from owner where O_email = '$email'";
            $data = mysqli_query($conn, $sql2);
            $result2 = mysqli_fetch_assoc($data);
            $_SESSION['owner'] = $result2['O_fname'];
            header("Location: owner_dashboard.php");
        }elseif($row['user_type'] == 'renter') {
            $sql3 = "select R_fname from renter where R_email = '$email'";
            $data2 = mysqli_query($conn, $sql3);
            $result3 = mysqli_fetch_assoc($data2);
            $_SESSION['renter'] = $result3['R_fname'];
            header("Location: renter_dashboard.php");
        }elseif($row['user_type']=='admin'){
            $sql4 = "select firstname from admin where email = '$email'";
            $data3 = mysqli_query($conn, $sql4);
            $result4 = mysqli_fetch_assoc($data3);
            $_SESSION['admin'] = $result4['firstname'];
            header("Location: admin_dashboard.php");
        }
    }
    else{
        echo '<script>alert("Login Failed. Invalid Input Data")</script>';
    }

}
?>