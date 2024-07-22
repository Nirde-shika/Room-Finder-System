<?php 
include("connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>About Us</title>
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .about-us {
            background-color: transparent; /* Transparent background */
            margin-top: 100px;
            position: relative;
            padding: 100px 0;
            text-align: left;
            overflow: hidden;
            font-family: 'Helvetica Neue', sans-serif; /* Clean and modern font */
        }

        .background-blur {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('images/aboutus.jpg') center/cover no-repeat;
            filter: blur(4px); /* Adjusted blur for better visibility */
            z-index: 1;
            /*opacity: 0.8; /* Reduced transparency for more visibility */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            /*background: rgba(255, 255, 255, 0.5); /* Reduced opacity for less whiteness */
        }

        .container {
            position: relative;
            z-index: 3;
            max-width: 80%; /* Slightly narrower for a cleaner look */
            margin: 0 auto; /* Center align the container */
            padding: 40px; /* Increased padding for more space */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
            border-radius: 8px; /* Rounded corners for sophistication */
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent background for text area */
        }

        .about-us h1 {
            font-size: 36px; /* Reduced size for modern look */
            margin-bottom: 20px;
            color: #333; /* Darker color for contrast */
            font-weight: 300; /* Light font weight for elegance */
        }

        .about-us p {
            font-size: 18px; /* Reduced size for readability */
            line-height: 1.6;
            text-align: justify;
            color: #666; /* Softer color for text */
            margin-bottom: 20px; /* Added margin for spacing */
        }


    </style>
</head>

<body>
    <div class="header">
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

    <section class="about-us">
        <div class="background-blur"></div>
        <div class="overlay"></div>
        <div class="container">
            <h1>About Us</h1>
            <p>RoomFinder is a comprehensive platform designed to streamline the property rental process by offering a user-friendly interface and real-time availability. It provides detailed property information, including high-quality photos and ensuring that renters have a clear understanding of what to expect.</p>
            <p>RoomFinder connects the right renters with the right properties at the right time, enhancing efficiency and reducing friction in the rental process.</p>
        </div>
    </section>
    
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