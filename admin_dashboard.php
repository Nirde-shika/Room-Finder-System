<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li>
                        <a href="#"><i class="fas fa-users"></i> Users</a>
                        <ul>
                            <li><a href="displayowner.php"><i class="fas fa-user-tie"></i> Owners</a></li>
                            <li><a href="displaytrenter.php"><i class="fas fa-user"></i> Renters</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
                        <ul>
                            <li><a href="displaytroom.php"><i class="fas fa-building"></i> Property Settings</a></li>
                            <li><a href="comment_settings.php"><i class="fas fa-comments"></i> Comment Settings</a></li>
                        </ul>
                    </li>
                    <li><a href="report.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                    <li><a href="ui.php" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i> Visit Website</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="headerdash">
                <div class="header-title">
                    <h1>Welcome <?php echo $_SESSION['admin']; ?></h1>
                </div>
                <div class="header-user">
                    <i class="fas fa-user"></i> Admin
                </div>
            </header>
            <section class="contentdash">
                <div class="content-header">
                    <h2>Dashboard</h2>
                </div>
                
                <div class="content-main">
                    <p>Welcome to the Admin Panel. Here, you have comprehensive access to manage and oversee user activities and property listings. Utilize this panel to get detailed reports on users and properties, update or delete listings as needed, and ensure the platform operates smoothly and efficiently.</p>
                </div>

                <div class="content-header">
                    <h2>General Report</h2>
                </div>
                
                <div class="content-main report-table">
                    <?php
                        include("connection.php");

                        $query = "SELECT 
                                    (SELECT COUNT(*) FROM owner) AS total_owner, 
                                    (SELECT COUNT(*) FROM renter) AS total_renter, 
                                    (SELECT COUNT(*) FROM room) AS total_room, 
                                    (SELECT COUNT(*) FROM comment) AS total_comment";

                        $data = mysqli_query($conn, $query);

                        if ($result = mysqli_fetch_assoc($data)) {
                            echo " <div class='report-cards'>
                            <div class='report-card'>
                                    <a href='displayowner.php'>
                                        <h3>Owner</h3>
                                        <p>{$result['total_owner']}</p>
                                    </a>
                                  </div>
                                  <div class='report-card'>
                                    <a href='displaytrenter.php'>
                                        <h3>Renter</h3>
                                        <p>{$result['total_renter']}</p>
                                    </a>
                                  </div>
                                  <div class='report-card'>
                                    <a href='displaytroom.php'>
                                        <h3>Room</h3>
                                        <p>{$result['total_room']}</p>
                                    </a>
                                  </div>
                                  <div class='report-card'>
                                    <a href='comment_settings.php'>
                                        <h3>Comment</h3>
                                        <p>{$result['total_comment']}</p>
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
