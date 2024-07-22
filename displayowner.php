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
        button.update, button.delete{
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
                    <li><a href="#"><i class="fas fa-cogs"></i> Settings</a>
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
                    <h2>Displaying all records of Owners</h2>
                </div>
                <div class="content-main">
                    <?php
                    include("connection.php");

                    $query = "select * from owner";
                    $data = mysqli_query($conn, $query);
                    $total = mysqli_num_rows($data);

                    if ($total != 0) {
                    ?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Operations</th>
                            </tr>
                            <?php
                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "<tr>
                                        <td>" . $result['O_id'] . "</td>
                                        <td>" . $result['O_fname'] . "</td>
                                        <td>" . $result['O_lname'] . "</td>
                                        <td>" . $result['O_gender'] . "</td>
                                        <td>" . $result['O_email'] . "</td>
                                        <td>" . $result['O_contact'] . "</td>
                                        <td>" . $result['O_address'] . "</td>
                                        <td>
                                            <a href='update_design.php?id=" . $result['O_id'] . "'><button class='update'><i class='fas fa-pencil-alt'></i> Update</button></a>
                                            <a href='delete.php?id=" . $result['O_id'] . "'><button class='delete' onclick='return checkdelete()'><i class='fas fa-trash-alt'></i> Delete</button></a>
                                        </td>
                                    </tr>";
                            }
                    } else {
                        echo "No records found";
                    }
                    ?>
                        </table>
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
