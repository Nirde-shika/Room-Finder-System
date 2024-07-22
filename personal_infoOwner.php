<?php
session_start();
include ("connection.php");
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

        section.contentdash .content-header h2 {
            margin: 0;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .property {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 500px;
        }

        .property-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .property-label {
            font-weight: bold;
            flex: 1;
            color: #555;
        }

        .property-value {
            flex: 2;
            color: #333;
        }

        button.update {
            display: inline-flex;
            align-items: center;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50; /* Green */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button.update i {
            margin-right: 8px;
        }

        button.update:hover {
            background-color: #45a049;
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
                    <h2>Personal Information</h2>
                </div>
                
                <div class="content-main">
                    <?php
                        $name = $_SESSION['owner'];
                        $query = "SELECT * FROM owner WHERE O_fname = '$name'";
                        $data = mysqli_query($conn, $query);
                        $result = mysqli_fetch_assoc($data);
                        echo "
                        <div class='property'>
                             <div class='property-row'>
                                <p class='property-label'>Name </p><p class='property-value'>".$result['O_fname']." ".$result['O_lname']."</p>
                            </div>
                            <div class='property-row'>
                                <p class='property-label'>Gender </p><p class='property-value'>".$result['O_gender']."</p>
                            </div>
                            <div class='property-row'>
                                <p class='property-label'>Email </p><p class='property-value'>".$result['O_email']."</p>
                            </div>
                            <div class='property-row'>
                                <p class='property-label'>Contact </p><p class='property-value'>".$result['O_contact']."</p>
                            </div>
                            <div class='property-row'>
                                <p class='property-label'>Address </p><p class='property-value'>".$result['O_address']."</p>
                            </div>
                            <a href='update_design.php?id=".$result['O_id']."'><button class='update'><i class='fas fa-pencil-alt'></i> Update</button></a>
                        </div>
                    ";
                    ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
