<?php
session_start();
if (!isset($_SESSION['owner'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Owner's Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="owner_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="uploadroom.php"><i class="fas fa-building"></i> List a Property</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> Settings</a>
                        <ul>
                            <li><a href="Ownerdisplayroom.php"><i class="fas fa-building"></i> Property</a></li>
                            <li><a href="personal_infoOwner.php"><i class="fas fa-user"></i> Personal Information</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fas fa-file-alt"></i> Reports</a></li>
                    <li><a href="ui.php" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i> Visit Website</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="headerdash">
                <div class="header-title">
                    <h1>Welcome <?php echo $_SESSION['owner']; ?></h1>
                </div>
                <div class="header-user">
                    <i class="fas fa-user"></i> Owner
                </div>
            </header>
            <section class="contentdash">
                <div class="content-header">
                    <h2>Dashboard</h2>
                </div>
                <div class="content-main">
                    <p>Welcome to the Owner Panel. Here, you have comprehensive access to manage and oversee your activities and property listings. Utilize this panel to get detailed reports on your properties, update or delete listings as needed, and ensure the platform operates smoothly and efficiently.</p>
                </div>
                <div class="content-main report-table">
                    <?php
                        include("connection.php");
                        $name = $_SESSION['owner'];
                        $query1 = "select O_id from owner where O_fname = '$name'";
                        $data1 = mysqli_query($conn, $query1);
                        $result1 = mysqli_fetch_assoc($data1);
                        $Oid = $result1['O_id'];                         
                        $query = "SELECT COUNT(*) as total_room FROM room where O_id = $Oid";

                        $data = mysqli_query($conn, $query);

                        if ($result = mysqli_fetch_assoc($data)) {
                            echo " <div class='report-cards'>
                                        <div class='report-card'>
                                            <a href='Ownerdisplayroom.php'>
                                                <h3>Rooms</h3>
                                                <p>{$result['total_room']}</p>
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
