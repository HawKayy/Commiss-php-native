<?php
    $hostname = 'localhost';
    $user = 'root';
    $password = 'a082254101546';
    $dbname = 'db_webcommiss'; 

    $conn = mysqli_connect($hostname,$user,$password,$dbname) or die ('gagal terhubung ke database');
?>