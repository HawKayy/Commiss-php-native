<?php
include 'db.php';

if($conn->connect_errno){
    echo $conn->connect_error;
    
}
else{
    echo 'berhasil konek';
}

?>