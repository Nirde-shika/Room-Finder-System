<?php 
session_start();
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomFinder</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FFFFFF; /* White */
            color: #2E4053; /* Dark Blue */
            font-family: Arial, sans-serif;
        }
        @media (max-width: 723px) {
            .header {
                flex-direction: column;
                align-items: center;
            }

            .header a {
                padding: 10px 0;
                font-size: 16px;
            }

            .header .btn a {
                padding: 5px 8px;
            }

            .hero {
                text-align: center;
                background: url('images/kirtipur.jpg') no-repeat center center/cover;
                padding: 100px 20px;
                color: #FFFFFF; /* White */
                margin-top: 100px;
            }

            .hero input {
                width: 100%;
                max-width: 300px;
            }
            
            .hero button {
                width: 100%;
                max-width: 100px;
                margin-top: 10px;
            }
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
    <div class="hero">
        <h1 style="font-size: 40px;">Discover Your Perfect Place.</h1>
        <form method="post" class="form" action="search.php">    
            <input type="text" placeholder="Search by location..." name="location">
            <input type="submit" value="Search" class="btn" name="search">
        </form>
    </div>
    <div class="content">
        <h2 style="text-align: left; font-size: 40px; margin:20px;">Properties For You</h2>
        <p style="text-align: left; font-size:20px; margin:20px;" >These Properties Are Popular Right Now. Find Your Ideal Place.</p>
        <div class="property-listings">
            <?php
                $query = "SELECT Room_no, Image, House_Address, RoomSize, RoomPrice, Rdescription FROM room order by Room_no desc LIMIT 8";
                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);
                if($total != 0){
                    while($result = mysqli_fetch_assoc($data)){
                        $description = explode("\n", $result['Rdescription'])[0];
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
                                /*<div class='property-row'>
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
                }    
            ?>
        </div>

        <div>
            <button onclick="loadMoreRoom()" class="see-more">See More</button>
        </div>

        <h2 style="text-align: left; font-size: 40px; margin:20px;">Top Rental Destinations</h2>
        <p style="text-align: left; font-size:20px; margin:20px;">Considering A Change? Check Out The Most Popular Cities And Discover New Destinations.</p>
        <div class="property-listings">
        <img src="images/optimized_cityscape.jpg" alt="City Image" style="padding: 5px 5px; width:30%; border-radius: 20px; height: 290px;">
            <div class="places">
                <ul style="font-size: 25px; margin-top: 30px;">
                    <li><a href="#" onclick="searchBy('Kathmandu')">Kathmandu</a></li>
                    <li><a href="#" onclick="searchBy('Bhaktapur')">Bhaktapur</a></li>
                    <li><a href="#" onclick="searchBy('Pokhara')">Pokhara</a></li>
                    <li><a href="#" onclick="searchBy('Dharan')">Dharan</a></li>
                    <li><a href="#" onclick="searchBy('Lalitpur')">Lalitpur</a></li>
                    <li><a href="#" onclick="searchBy('Banepa')">Banepa</a></li>
                    <li><a href="#" onclick="searchBy('Dhangadhi')">Dhangadhi</a></li>
                    <li><a href="#" onclick="searchBy('Hetauda')">Hetauda</a></li>
                </ul>
            </div>
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
            alert("Please Login To View The Post.");
        }

        function loadMoreRoom(){
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'loadmoreRoom.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector('.property-listings').innerHTML = xhr.responseText;
                    document.querySelector('.see-more').style.display = 'none';
                }
            };
            xhr.send();

        }

        function searchBy(location){
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajaxRoom.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.querySelector('.property-listings').innerHTML = xhr.responseText;
                }
            };
            xhr.send('search=true&location=' + location);

        }

        
    </script>
</body>
</html>