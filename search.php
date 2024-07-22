<?php 
session_start();
include("connection.php");
?>
<html>
    <head>
        <title>Rooms</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #F8F9FA;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo"><a href="ui.php" style="font-size: 35px;font-weight: bold;margin: 0px;text-decoration: none;">RoomFinder</a></div>
            <nav>
                <a href="uploadroom.php">List Property</a>
                <a href="contact.php">Contact</a>
                <a href="aboutus.php">About Us</a>
                <button class="btn"><a href="B4register.php">Register</a></button>
                <button class="btn"><a href="login.php">Log In</a>
                </button>
            </nav>
        </div>
        <div class="hero">
            <h1 style="font-size: 40px;">Discover Your Perfect Place.</h1>
            <form method="post" class="form" action="search.php">    
                <input type="text" placeholder="Search by location..." name="location">
                <input type="submit" value="Search" class="btn" name="search">
            </form>
        </div>
        <div class="content">
            <h2 style="text-align: left; font-size: 40px; margin-left: 30px">Properties For You</h2>
            <div class="property-listings">
            <?php
            if(isset($_POST['search']))
            {
                $location = $_POST['location'];

                $query = "select * from room where House_Address like '%$location%' ORDER BY Room_no DESC;";
                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);

                if($total !=0){
                    while($result = mysqli_fetch_assoc($data)){
                        ?>
                        <div class="property">
                <?php
                    echo "
                    <img src='".$result['Image']."' alt='Property Image'>
                    <h3>".$result['House_Address']."</h3>
                    <div class='property-row'>
                        <p class='property-label'>Size: </p><p class='property-value'>".$result['RoomSize']."</p>
                    </div>
                    <div class='property-row'>
                        <p class='property-label'>Price: </p><p class='property-value'>Rs.".$result['RoomPrice']."</p>
                    </div>";
                    /*
                    <div class='property-row'>
                        <p class='property-label'>Description: </p><p class='property-value'>".$description."</p>
                    </div><br>";*/

                    $roomid = $result['Room_no'];

                    if(isset($_SESSION['admin'])){
                        echo "<button onclick=\"window.location.href='update_designRoom.php?id=$roomid'\" target='_blank'>Edit Post</button><br>";
                    }
                    
                    if(isset($_SESSION['admin']) || isset($_SESSION['owner']) || isset($_SESSION['renter'])){
                        echo "<button onclick=\"window.open('view_post.php?id=$roomid', '_blank')\" >View Post</button><br>";
                    } else {
                        echo "<button onclick='showPopup()'>View Post</button>";
                    }
                ?>
            </div>
                    <?php
                    }
                }else {
                    echo "<p>No rooms found in $location</p>";
                }
            }
            ?>
            </div>
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
        <script>
            function showPopup() {
            alert("You need to register first.");
            }
        </script>
    </body>       
</html>
