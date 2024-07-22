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

$query = "select * from owner where O_id = '$getId'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Operations</title>
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
                <a href="personal_infoOwner.php" class="close-button">×</a>
                <?php
            }
            ?>
    <form action="#" method="POST">
        <div class="title">
            Update Details
        </div>

        <div class="form">
            <div class="input_field">
                <label>First Name</label>
                <input type="text" value="<?php echo $result['O_fname'] ?>" class="input" name="fname" required>
            </div>

            <div class="input_field">
                <label>Last Name</label>
                <input type="text" value="<?php echo $result['O_lname'] ?>" class="input" name="lname" required>
            </div>

            <div class="input_field">
                <label>Password</label>
                <input type="password" value="<?php echo $result['O_password'] ?>" class="input" name="password" required>
            </div>

            <div class="input_field">
                <label>Confirm Password</label>
                <input type="password" value="<?php echo $result['O_cpassword'] ?>" class="input" name="conpassword" required>
            </div>

            <div class="input_field">
                <label>Gender</label>
                <div class="select_box">
                    <select name="gender" required>
                        <option value="">Select</option>

                        <option value="male"
                        <?php
                            if($result['O_gender'] == 'Male'){
                                echo "selected";
                            }
                        ?>
                        >Male</option>
                        <option value="female" 
                        <?php
                            if($result['O_gender'] == 'Female'){
                                echo "selected";
                            }
                        ?>
                        >Female</option>
                        <option value="others"
                        <?php
                            if($result['O_gender'] == 'Others'){
                                echo "selected";
                            }
                        ?>
                        >Others</option>
                    </select>
                </div>
            </div>

            <div class="input_field">
                <label>Email</label>
                <input type="email" value="<?php echo $result['O_email'] ?>" class="input" name="email">
            </div>

            <div class="input_field">
                <label>Phone</label>
                <input type="text" value="<?php echo $result['O_contact'] ?>" class="input" name="phone" required>
            </div>

            <div class="input_field">
                <label>Address</label>
                <textarea class="textarea" name="address" required><?php echo $result['O_address'] ?>
                </textarea>
            </div>

            <div class="input_field terms">
                <label class="check">
                    <input type="checkbox" required>
                    <span class="checkcolor"></span>
                </label>
                <p>Agree to terms and conditions.</p>
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
    if(isset($_POST['update']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pwd = $_POST['password'];
        $conpwd = $_POST['conpassword'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if($fname !="" && $lname !="" && $pwd !="" && $conpwd !="" && $gender !="" && $email !="" && $phone !="" && $address !="")
       {
                $query = "update owner set O_fname='$fname',O_lname='$lname',O_password ='$pwd',O_cpassword ='$conpwd',O_gender='$gender',O_email='$email',O_contact='$phone',O_address='$address' where O_id = '$getId'";
            $data = mysqli_query($conn, $query);
            if($data){
                echo "<script>alert('Record Updated.')</script>";
                ?>
                <meta http-equiv="refresh" content="0; url=http://localhost/crud/displayowner.php">
                <?php
            }
            else{
                echo "Failed to Update.";
            }
        }
        else{
            echo "<script>alert('Please fill the form.')</script>";
        }
    }
?>