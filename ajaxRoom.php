<?php 
session_start();
include("connection.php");

//if(isset($_POST['search'])) {
    $location = $_POST['location'];

    $query = "SELECT Room_no, Image, House_Address, RoomSize, RoomPrice, Rdescription 
                FROM room WHERE House_Address LIKE '%$location%' ORDER BY Room_no DESC;";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if($total != 0) {

        while($result = mysqli_fetch_assoc($data)) {
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
                    </div>
                    <div class='property-row'>
                        <p class='property-label'>Description: </p><p class='property-value'>".$description."</p>
                    </div><br>";

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
    } else {
        echo "<p style='font-size: 23px; align-items: left; margin: 0px;'>Sorry, No rooms found in $location.</p>";
    }
?>
