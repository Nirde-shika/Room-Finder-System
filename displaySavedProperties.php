<?php
session_start();
include("connection.php");
if (!isset($_SESSION['renter'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Your existing styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            background-color: #f4f6f8;
        }
        section.contentdash .content-header h2 {
            margin: 0;
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        .hero {
            margin-top: 0;
            text-align: left;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            width: 100%;
            height: 100%;
        }
        .form {
            display: flex;
            align-items: left;
        }
        .hero .form input {
            font-size: 16px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #AEB6BF;
            margin-top: 10px;
            outline: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 25px;
        }
        .form input[type="text"],
        .form input[type="number"] {
            margin-right: 10px;
            margin-left: 25px;
            align-items: center;
            padding: 15px;
            font-size: 16px;
        }
        .form input[type="submit"] {
            padding: 15px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 25px;
            margin-top: 5px;
            transition: background-color 0.3s;
        }
        .property {
            background-color: #AEB6BF;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .property img {
            width: 100%;
            height: 200px;
            border-radius: 10px;
        }
        .property h3 {
            margin: 15px 0;
        }
        .property-row {
            display: flex;
        }
        .property-label {
            font-weight: bold;
        }
        .property-value {
            margin-left: 10px;
        }
        .property button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .property .save-btn, .property .unsave-btn {
            position: absolute;
            top: 5px;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 15px;
        }
        .property .unsave-btn {
            right: 5px;
            background-color: red;
            color: white;
        }
        @media (max-width: 768px) {
            .hero {
                width: 90%;
            }
            .form input[type="text"],
            .form input[type="number"],
            .form input[type="submit"] {
                width: calc(100% - 40px);
                margin-left: 20px;
            }
        }
    </style>
    <title>Renter Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Renter's Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="renter_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="rentersearch.php"><i class="fas fa-search"></i> Search Rooms</a></li>
                    <li><a href="displaySavedProperties.php"><i class="fa fa-bookmark" aria-hidden="true"></i> Saved Properties</a></li>
                    <li><a href="personal_infoRenter.php"><i class="fas fa-user"></i> Personal Information</a></li>
                    <!--<li><a href="renter_settings.php"><i class="fas fa-cogs"></i> Settings</a></li>-->
                    <li><a href="ui.php" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i> Visit Website</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="headerdash">
                <div class="header-title">
                    <h1>Welcome <?php echo $_SESSION['renter']; ?></h1>
                </div>
                <div class="header-user">
                    <i class="fas fa-user"></i> Renter
                </div>
            </header>
            <section class="contentdash">
                <div class="content-header">
                    <h2><a href="rentersearch.php" style="text-decoration:none; color:black;">Saved Properties</a></h2>
                </div>
                <div class="content-main">
                    <div class="content">
                        <div class="property-listings">
                            <?php
                                $name = $_SESSION['renter'];
                                $query1 = "SELECT R_id FROM renter WHERE R_fname = '$name'";
                                $data1 = mysqli_query($conn, $query1);
                                $result1 = mysqli_fetch_assoc($data1);
                                $renter1 = $result1['R_id'];

                                $query = "SELECT room.Room_no, room.Image, room.House_Address, room.RoomSize, room.RoomPrice, room.Rdescription 
                                          FROM save 
                                          JOIN room ON save.Room_no = room.Room_no 
                                          WHERE save.R_id = $renter1  order by save.id desc";
                                $data = mysqli_query($conn, $query);
                                $total = mysqli_num_rows($data);
                                if ($total != 0) {
                                    while ($result = mysqli_fetch_assoc($data)) {
                                        $roomid = $result['Room_no'];
                                        ?>
                                        <div class="property">
                                            <img src="<?php echo $result['Image']; ?>" alt="Property Image">
                                            <h3><?php echo $result['House_Address']; ?></h3>
                                            <div class="property-row">
                                                <p class="property-label">Size: </p><p class="property-value"><?php echo $result['RoomSize']; ?></p>
                                            </div>
                                            <div class="property-row">
                                                <p class="property-label">Price: </p><p class="property-value">Rs.<?php echo $result['RoomPrice']; ?></p>
                                            </div>
                                            <button class="unsave-btn" onclick="confirmUnsave(<?php echo $roomid; ?>)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <?php
                                            if (isset($_SESSION['admin'])) {
                                                echo "<button onclick=\"window.location.href='update_designRoom.php?id=$roomid'\" target='_blank'>Edit Post</button><br>";
                                            }

                                            if (isset($_SESSION['admin']) || isset($_SESSION['owner']) || isset($_SESSION['renter'])) {
                                                echo "<button onclick=\"window.open('view_post.php?id=$roomid', '_blank')\">View Post</button><br>";
                                            } else {
                                                echo "<button onclick='showPopup()'>View Post</button>";
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "<p>No saved properties found.</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script>
        function confirmUnsave(roomId) {
            if (confirm("Are you sure you want to unsave this property?")) {
                unsaveProperty(roomId);
            }
        }

        function unsaveProperty(roomId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "unsaveproperty.php?id=" + roomId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Property Unsaved.");
                    location.reload();
                }
            };
            xhr.send();
        }
        function showPopup() {
            alert("Please log in to view the post.");
        }
    </script>
</body>
</html>
