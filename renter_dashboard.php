<?php
session_start();
include ("connection.php");
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
    <title>Renter Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            background-color: #f4f6f8;
        }
    </style>
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
                    <h2>Dashboard</h2>
                </div>
                <div class="content-main">
                    <p>Welcome. This is the Renter Panel. You have complete access to the room's details here. You may look up the location of the room and go through them all.</p>
                </div>
                <div class="content-header">
                    <h2>General Report</h2>
                </div>
                
                <div class="content-main report-table">
                    <?php
                        include("connection.php");

                        $query = "SELECT COUNT(*) as total_saved FROM save";
                        $data = mysqli_query($conn, $query);

                        if ($result = mysqli_fetch_assoc($data)) {
                            echo " <div class='report-cards'>
                                        <div class='report-card'>
                                            <a href='displaySavedProperties.php'>
                                                <h3>Saved</h3>
                                                <p>{$result['total_saved']}</p>
                                            </a>
                                        </div> 
                                    </div>";
                        } else {
                            echo "Error retrieving data";
                        }
                    ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
