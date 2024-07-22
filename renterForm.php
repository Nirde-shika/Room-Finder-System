<?php 
include("connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter's Form</title>
</head>
<body>
    <div class="container">
        <a href="ui.php" class="close-button">×</a>
        <form id="registrationForm" action="#" method="POST">
            <div class="title">
                Registration Form
            </div>
            <div class="form">
                <div class="input_field">
                    <label>First Name</label>
                    <input id="firstName" type="text" class="input" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>" required>
                </div>
                <div class="input_field">
                    <label>Last Name</label>
                    <input id="lastName" type="text" class="input" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>" required>
                </div>
                <div class="input_field">
                    <label>Password</label>
                    <input id="password" type="password" class="input" name="password" required>
                </div>
                <div class="input_field">
                    <label>Confirm Password</label>
                    <input id="confirmPassword" type="password" class="input" name="conpassword" required>
                </div>
                <div class="input_field">
                    <label>Gender</label>
                    <div class="select_box">
                        <select name="gender" id="gender" required>
                            <option value="">Select</option>
                            <option value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'female') echo 'selected'; ?>>Female</option>
                            <option value="others" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'others') echo 'selected'; ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="input_field">
                    <label>Email</label>
                    <input id="email" type="email" class="input" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>
                <div class="input_field">
                    <label>Phone</label>
                    <input id="phone" type="text" class="input" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>
                </div>
                <div class="input_field">
                    <label>Birth Place</label>
                    <textarea id="baddress" class="textarea" name="baddress" required><?php echo isset($_POST['baddress']) ? $_POST['baddress'] : ''; ?></textarea>
                </div>

                <div class="input_field">
                    <label>Current Address</label>
                    <textarea id="caddress" class="textarea" name="caddress" required><?php echo isset($_POST['caddress']) ? $_POST['caddress'] : ''; ?></textarea>
                </div>

                <div class="input_field terms">
                    <label class="check">
                        <input id="terms" type="checkbox" required <?php if(isset($_POST['register'])) echo 'checked'; ?>>
                        <span class="checkcolor"></span>
                    </label>
                    <p>Agree to terms and conditions.</p>
                </div>
                <div class="input_field">
                    <input type="submit" value="Register" class="btn" name="register">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['register']))
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


    $errors = [];

    // Validate fields
    if(empty($fname) || empty($lname) || empty($pwd) || empty($conpwd) || empty($gender) || empty($email) || empty($phone) || empty($baddress) || empty($caddress)) {
        $errors[] = "All fields are required.";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if(!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Phone number must be 10 digits.";
    }
    if(strlen($pwd) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if($pwd !== $conpwd) {
        $errors[] = "Passwords do not match.";
    }

    if(count($errors) > 0) {
        foreach($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        $query = "INSERT INTO renter (R_fname, R_lname, R_password, R_cpassword, R_gender, R_email, R_contact, R_birthplace, R_currentAddress) VALUES ('$fname', '$lname', '$pwd', '$conpwd', '$gender', '$email', '$phone', '$baddress', '$caddress')";
        $data = mysqli_query($conn, $query);
        if($data) {
            echo "<script>alert('Data Inserted into Database');</script>";
            header("Location: login.php");
        } else {
            echo "<script>alert('Failed to insert data');</script>";
        }
    }
}
?>
