<?php 
session_start();
include("connection.php");


    $query = "SELECT * FROM room order by Room_no desc";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if($total != 0) {
        while($result = mysqli_fetch_assoc($data)) {
            ?>
            <div class='property'>
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
                    <p class='property-label'>Description: </p><p class='property-value'>".$result['Rdescription']."</p>
                </div><br>";*/

                $roomid = $result['Room_no'];

                if(isset($_SESSION['admin'])){
                    echo "<button onclick=\"window.location.href='update_designRoom.php?id=$roomid'\">Edit Post</button><br>";
                }
                
                if(isset($_SESSION['admin']) || isset($_SESSION['owner']) || isset($_SESSION['renter'])){
                    echo "<button onclick=\"window.location.href='view_post.php?id=$roomid'\">View Post</button><br>";
                } else {
                    echo "<button onclick='showPopup()'>View Post</button>";
                }   
                ?>
            </div>
        <?php
        }
    } else {
        echo "No more properties to load.";
    }
?>
