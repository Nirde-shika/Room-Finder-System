<?php
session_start();
if(isset($_SESSION['admin'])){
    echo "Welcome ".$_SESSION['admin'];
} elseif(isset($_SESSION['renter'])){
    echo "Welcome ".$_SESSION['renter'];
}
?>

<?php 
include("connection.php"); 
$getId = $_GET['id'];

$query = "select * from renter where R_id = '$getId'";
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
        <a href="displaytrenter.php" class="close-button">×</a>
        <?php
        }else{
            ?>
            <a href="personal_infoRenter.php" class="close-button">×</a>
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
                <input type="text" value="<?php echo $result['R_fname'] ?>" class="input" name="fname" required>
            </div>

            <div class="input_field">
                <label>Last Name</label>
                <input type="text" value="<?php echo $result['R_lname'] ?>" class="input" name="lname" required>
            </div>

            <div class="input_field">
                <label>Password</label>
                <input type="password" value="<?php echo $result['R_password'] ?>" class="input" name="password" required>
            </div>

            <div class="input_field">
                <label>Confirm Password</label>
                <input type="password" value="<?php echo $result['R_cpassword'] ?>" class="input" name="conpassword" required>
            </div>

            <div class="input_field">
                <label>Gender</label>
                <div class="select_box">
                    <select name="gender" required>
                        <option value="">Select</option>

                        <option value="male"
                        <?php
                            if($result['R_gender'] == 'Male'){
                                echo "selected";
                            }
                        ?>
                        >Male</option>
                        <option value="female" 
                        <?php
                            if($result['R_gender'] == 'Female'){
                                echo "selected";
                            }
                        ?>
                        >Female</option>
                        <option value="others"
                        <?php
                            if($result['R_gender'] == 'Others'){
                                echo "selected";
                            }
                        ?>
                        >Others</option>
                    </select>
                </div>
            </div>

            <div class="input_field">
                <label>Email</label>
                <input type="email" value="<?php echo $result['R_email'] ?>" class="input" name="email">
            </div>

            <div class="input_field">
                <label>Phone</label>
                <input type="text" value="<?php echo $result['R_contact'] ?>" class="input" name="phone" required>
            </div>

            <div class="input_field">
                <label>Birth Place</label>
                <textarea class="textarea" name="baddress" required><?php echo $result['R_birthplace'] ?>
                </textarea>
            </div>

            <div class="input_field">
                <label>Current Address</label>
                <textarea class="textarea" name="caddress" required><?php echo $result['R_currentAddress'] ?>
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
        $baddress = $_POST['baddress'];
        $caddress = $_POST['caddress'];

        if($fname !="" && $lname !="" && $pwd !="" && $conpwd !="" && $gender !="" && $email !="" && $phone !="" && $baddress !="" && $caddress !="")
       {
        $caddress = $_POST['caddress'];
                $query = "update renter set R_fname='$fname',R_lname='$lname',R_password ='$pwd',R_cpassword ='$conpwd',R_gender='$gender',R_email='$email',R_contact='$phone',R_birthplace='$baddress', R_currentAddress='$caddress' where R_id = '$getId'";
            $data = mysqli_query($conn, $query);
            if($data){
                echo "<script>alert('Record Updated.')</script>";
                if(isset($_SESSION['admin'])){
                ?>
                    <meta http-equiv="refresh" content="0; url=http://localhost/crud/displaytrenter.php">
                <?php
                }elseif(isset($_SESSION['renter'])){
                    ?>
                    <meta http-equiv="refresh" content="0; url=http://localhost/crud/personal_infoRenter.php">
                    <?php
                }
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