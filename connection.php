<?php
    $servername = "localhost";
    $username = "root";
    $password = "2003Nirde2060";
    $dbname = "rfs";
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if($conn){
        //echo "Connection established";
    }

    else{
        echo"Connection Failed";
    }
?>