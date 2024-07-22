<?php 
session_start();
include("connection.php");
$getid = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>View Post</title>
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .dashboard-button-container {
            text-align: left;
            margin-left: 5px;
            margin-top: 90px;
        }

        .dashboard-button {
            display: inline-flex;
            align-items: center;
            background-color: #2196F3; /* Blue */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dashboard-button i {
            margin-right: 8px;
        }

        .dashboard-button:hover {
            background-color: #0b7dda;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .propertyview {
            margin-top: 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .image {
            width: 100%;
            max-width: 800px;
            margin-bottom: 10px;
            position: relative; /* Added for positioning the save button */
        }
        .fixed-size-img {
            width: 100%;
            max-width: 800px;
            height: 560px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .save-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #FFA500; 
            color: white;
            padding: 10px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .save-button i {
            font-size: 20px;
        }
        .save-button:hover {
            color: #495057;
        }
        .info {
            align-items: flex-start;
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: auto;
            margin-bottom: 15px;
        }
        .info h3 {
            margin-top: 0;
            margin-bottom: 15px;
        }
        
        .info .ownerinfo, .info .details {
            margin-bottom: 20px;
        }
        .info .ownerinfo p, .info .details p {
            margin: 5px 0;
        }
        .property-row {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }
        .property-label {
            width: 150px;
            font-weight: bold;
            color: #495057;
            text-align: right;
        }
        .property-value {
            font-weight: normal;
            color: #495057;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin: 20px 0;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        .navigation a {
            text-decoration: none;
            font-size: 20px;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .navigation a:hover {
            background-color: #0056b3;
        }
        @media (max-width: 800px) {
            .propertyview {
                padding: 10px;
            }
            .info {
                padding: 10px;
            }
            .navigation {
                flex-direction: column;
                align-items: center;
            }
            .navigation a {
                margin: 10px 0;
            }
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
            <button class="btn"><a href="login.php">Log In</a></button>
        </nav>
    </div>
    <?php if(isset($_SESSION['admin'])): ?>
        <div class="dashboard-button-container">
            <a href="displaytroom.php" class="dashboard-button">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    <?php elseif(isset($_SESSION['owner'])): ?>
        <div class="dashboard-button-container">
            <a href="Ownerdisplayroom.php" class="dashboard-button">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    <?php elseif(isset($_SESSION['renter'])): ?>
        <div class="dashboard-button-container">
            <a href="rentersearch.php" class="dashboard-button">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    <?php endif; ?>
    <div class="propertyview">
        <div class="image">
            <?php
                $query = "SELECT * FROM room WHERE Room_no = '$getid'";
                $data = mysqli_query($conn, $query);
                $result = mysqli_fetch_assoc($data);
                echo "<img src='".$result['Image']."' alt='Property Image' class='fixed-size-img'>";
            ?>
            <button class="save-button"><i class="fas fa-save"></i></button> <!-- Save button -->
        </div>
        <div class="info">
            <div class="ownerinfo">
                <?php
                    $query1 = "SELECT O_id FROM room WHERE Room_no = '$getid'";
                    $data1 = mysqli_query($conn, $query1);
                    $result1 = mysqli_fetch_assoc($data1);
                    $Oid = $result1['O_id'];

                    $query2 = "SELECT O_fname, O_lname, O_email, O_contact FROM owner WHERE O_id = '$Oid'";
                    $data2 = mysqli_query($conn, $query2);
                    $result2 = mysqli_fetch_assoc($data2);

                    echo "
                        <h3 style='text-decoration: underline;'>Owner Information:</h3>
                        <div class='property-row'>
                        <p class='property-label'><strong>Name</strong></p>
                        <p class='property-value'>".$result2['O_fname']." ".$result2['O_lname']."</p>
                        </div>
                        <div class='property-row'>
                        <p class='property-label'><strong>Contact</strong></p><p class='property-value'>".$result2['O_contact']."</p>
                        </div>
                        <div class='property-row'>
                        <p class='property-label'><strong>Email</strong></p>
                        <p class='property-value'>".$result2['O_email']."</p>
                        </div>";
                ?>
            </div>
            <div class="details">
                <?php
                    echo "
                        <h3 style='text-decoration: underline;'>Room Details:</h3>
                        <div class='property-row'>
                            <p class='property-label'>House Address</p>
                            <p class='property-value'>".$result['House_Address']."</p>
                        </div>
                        <div class='property-row'>
                            <p class='property-label'>House no.</p>
                            <p class='property-value'>".$result['House_no']."</p>
                        </div>
                        <div class='property-row'>
                            <p class='property-label'>Zip Code</p>
                            <p class='property-value'>".$result['Zip_code']."</p>
                        </div>
                        <div class='property-row'>
                            <p class='property-label'>Size</p>
                            <p class='property-value'>".$result['RoomSize']."</p>
                        </div>
                        <div class='property-row'>
                            <p class='property-label'>Price</p>
                            <p class='property-value'>Rs.".$result['RoomPrice']."</p>
                        </div>
                        <div class='property-row'>
                            <p class='property-label'>Description</p>
                            <p class='property-value'>".$result['Rdescription']."</p>
                        </div>
                    ";
                ?>
            </div>
        </div>
    </div>
    <div class="navigation">
        <?php 
            $next_query = "SELECT Room_no FROM room WHERE Room_no < '$getid' ORDER BY Room_no desc LIMIT 1";
            $next_data = mysqli_query($conn, $next_query);
            $next_result = mysqli_fetch_assoc($next_data);
            $next_id = $next_result['Room_no'] ?? null;

            $prev_query = "SELECT Room_no FROM room WHERE Room_no > '$getid' ORDER BY Room_no asc LIMIT 1";
            $prev_data = mysqli_query($conn, $prev_query);
            $prev_result = mysqli_fetch_assoc($prev_data);
            $prev_id = $prev_result['Room_no'] ?? null;

            if ($prev_id): ?>
                <a href="view_post.php?id=<?php echo $prev_id; ?>">&larr; Previous</a>
        <?php endif; ?>
        <?php if ($next_id): ?>
            <a href="view_post.php?id=<?php echo $next_id; ?>">Next &rarr;</a>
        <?php endif; ?>
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
