<?php
    $hostname = 'localhost';
    $user = 'hepha';
    $password = 'Heph123@';
    $dbname = 'db_webcommiss'; 

    $conn = mysqli_connect($hostname,$user,$password,$dbname);
    if($conn->connect_errno){
        echo $conn->connect_error;
        die;
    }
?>
