<?php 
include("connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
    body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 100px;
            padding: 20px;
        }

        .contact-us {
            flex: 1;
            background: url('images/contactus.jpg') no-repeat center center/cover;
            height: 420px;
            max-width: 50%;
            position: relative;
            margin-right: 0px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-left: 100px;
            border-radius: 5px;
        }

        .contact-us h1 {
            color: white;
            font-size: 50px;
            background: none;
            margin: 20px;
            margin-right: 50px;
        }

        .container{
            margin-top: 0px;
            margin-left: 0px;
            align-items: end;
        }

        .icon{
            margin-left: 30px;
            margin-bottom: 30px;
        }

        
</style>
</head>
<body>
    <div class="header" style="margin: 0;">
        <div class="logo"><a href="ui.php" style="font-size: 35px;font-weight: bold;margin: 0px;text-decoration: none;">RoomFinder</a></div>
        <nav>
            <a href="uploadroom.php">List Room</a>
            <a href="contact.php">Contact</a>
            <a href="aboutus.php">About Us</a>
            <button class="btn"><a href="B4register.php">Register</a></button>
            <button class="btn"><a href="login.php">Log In</a>
            </button>
        </nav>
    </div>
    
    <div class="main-container">
        <section class="contact-us">
            <h1>Contact Us</h1>
        </section>

        <div class="container">
            <form class="registrationForm" action="#" method="post">
                <div class="title">Give Us Your Insight</div>
                <div class="form">
                    <div class="input_field"><input class="input" id="firstName" type="text" name="name" placeholder="Enter Name"></div>
                    <div class="input_field"><input class="input" id="email" type="email" name="email" placeholder="Enter Email"></div>
                    <div class="input_field"><textarea class="textarea" id="address" rows="5" name="message" placeholder="Your Suggestion"></textarea></div>
                    <div class="input_field">
                        <input type="submit" value="Submit" class="btn" name="register">
                    </div>          
                </div>
            </form>
        </div>
    </div>

    <div class="icon">
    <h2 style="margin-bottom: 20px ">Contact Info</h2>
    <p style="margin-top:10px;"><span class="material-symbols-outlined">home</span>  Kirtipur, Kathmandu</p>
    <p style="margin-top:10px;"><span class="material-symbols-outlined">call</span>  9800030506</p>
    <p style="margin-top:10px;"><span class="material-symbols-outlined">mail</span>  roomfinder66@gmail.com</p>
    </div>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="logo-section">
                <div class="logo">RoomFinder</div>
                <p>Whether you're looking for small cozy rooms or spacious large ones, all with reasonable rent, we've got you covered.</p>
            </div>
            
            <div class="quick-links">
                <h3>Quick Links</h3>
                <nav>
                    <a href="aboutus.php">About Us</a>
                    <a href="contact.php">Contact</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">FAQ</a>
                </nav>
            </div>
            
            <div class="social-media">
                <h3>Follow Us</h3>
                <nav>
                    <a href="https://facebook.com" target="_blank">Facebook</a>
                    <a href="https://twitter.com" target="_blank">Twitter</a>
                    <a href="https://instagram.com" target="_blank">Instagram</a>
                    <a href="https://linkedin.com" target="_blank">LinkedIn</a>
                </nav>
            </div>
            
            <div class="contact-info">
                <h3>Contact Us</h3>
                <p>Email: roomfinder66@gmail.com</p>
                <p>Phone: 9800030506</p>
                <p>Address: Kirtipur, Kathmandu, Nepal</p>
            </div>

            <!--<div class="newsletter">
                <h3>Subscribe to Our Newsletter</h3>
                <form>
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>--->
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 RoomFinder. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>

<?php
    if(isset($_POST['register']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        if($name !="" && $email !="" && $message !=""){
            
            $query = "insert into comment (comName, comEmail, comMessage) values('$name', '$email', '$message')";

            $data = mysqli_query($conn, $query);

            if($data){
                echo "<script>alert('Thank you for your Suggestion')</script>";
            }else{
                echo "<script>alert('Sorry can you please try again')</script>";
            }
        
    }else{
            echo "<script>alert('Please fill the form.')</script>";
        }
    }

?>