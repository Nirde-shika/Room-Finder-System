<?php
session_start();
if (!isset($_SESSION['owner'])) {
    header('Location: login.php');
    exit();
}

include("connection.php");
$name = $_SESSION['owner'];

// Use a prepared statement to fetch the owner ID
$query1 = $conn->prepare("SELECT O_id FROM owner WHERE O_fname = ?");
$query1->bind_param("s", $name);
$query1->execute();
$data2 = $query1->get_result();
$result2 = $data2->fetch_assoc();

$owner_id = $result2['O_id'] ?? null;
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

        section.contentdash .content-header h2 {
            margin: 0;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        section.contentdash .content-main table {
            width: 100%;
            border-collapse: collapse;
        }
        section.contentdash .content-main table th, 
        section.contentdash .content-main table td {
            border: 1px solid #dcdcdc;
            padding: 5px;
            text-align: left;
        }
        section.contentdash .content-main table th {
            background-color: #ecf0f1;
        }
        button.update, button.delete, button.view {
            display: inline-flex;
            align-items: center;
            border: none;
            padding: 10px;
            margin: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 50%;
        }

        button.update {
            background-color: #4CAF50; /* Green */
            transition: background-color 0.3s ease;
        }

        button.delete {
            background-color: #F44336; /* Red */
            transition: background-color 0.3s ease;

        }

        button.view {
            background-color: #607D8B; /* Gray */
            transition: background-color 0.3s ease;

        }

        button i {
            margin-right: 5px;
        }
        button.update:hover {
            text-decoration: underline;
            color: black;
            background-color: #45a049;
        }
        button.delete:hover {
            text-decoration: underline;
            color: black;
            background-color: #C41E3A;
        }
        button.view:hover {
            text-decoration: underline;
            color: black;
            background-color: #697D87;
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
                    <h1>Welcome <?php echo htmlspecialchars($_SESSION['owner']); ?></h1>
                </div>
                <div class="header-user">
                    <i class="fas fa-user"></i> Owner
                </div>
            </header>
            <section class="contentdash">
                <div class="content-header">
                    <h2>Displaying all records of Room</h2>
                </div>
                <div class="content-main">
                    <?php
                    if ($owner_id) {
                        // Use a prepared statement to fetch rooms
                        $query = $conn->prepare("SELECT * FROM room WHERE O_id = ?");
                        $query->bind_param("i", $owner_id);
                        $query->execute();
                        $data = $query->get_result();
                        $total = $data->num_rows;

                        if ($total != 0) {
                            echo '<table>
                                    <tr>
                                    
                                    <th>Image</th>
                                    <th>Address</th>
                                    <th>Room Size</th>
                                    <th>Room Price</th>
                                    <th>House Number</th>
                                    <th>Zip Code</th>
                                    <th>Description</th>
                                    <th>Operations</th>
                                    </tr>';
                            while ($result = $data->fetch_assoc()) {
                                echo "<tr>
                                        
                                        <td><img src='{$result['Image']}' height='100px' width='100px'></td>
                                        <td>{$result['House_Address']}</td>
                                        <td>{$result['RoomSize']}</td>
                                        <td>{$result['RoomPrice']}</td>
                                        <td>{$result['House_no']}</td>
                                        <td>{$result['Zip_code']}</td>
                                        <td>{$result['Rdescription']}</td>
                                        <td>
                                            <a href='update_designRoom.php?id={$result['Room_no']}'><button class='update'><i class='fas fa-pencil-alt'></i> Update</button></a>
                                            <a href='deleteRoom.php?id={$result['Room_no']}'><button class='delete' onclick='return checkdelete()'><i class='fas fa-trash-alt'></i> Delete</button></a>
                                            <a href='view_post.php?id={$result['Room_no']}'><button class='view'><i class='fas fa-eye'></i> View</button></a>

                                        </td>
                                      </tr>";
                            }
                            echo '</table>';
                        } else {
                            echo "No records found";
                        }

                        $query->close();
                    } else {
                        echo "Owner not found.";
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>
    <script>
        function checkdelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>
</body>
</html>
