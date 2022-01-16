<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body id="bg-login">
    <div class="container">
        <h2> Register | Kay's Gallery </h2>
         <form method="POST" action="">
         <input type="text" name="nama" placeholder="Full Name" class ="input-control" require>
            <input type="text" name="user" placeholder="Username" class ="input-control" require>
            <input type="password" name="pass" placeholder="Password" class ="input-control"  require>
            <input type="text" name="hp" placeholder="Phone" class ="input-control"  require>
            <input type="email" name="email" placeholder="Email" class ="input-control"  require>
            <input type="text" name="alamat" placeholder="Adress" class ="input-control"  require>
            <input type="hidden" name="submit" value="register">
            <button type="submit" name="submit" class=btn> Register </button>


            
            </form> 

<?php
    if (isset($_POST['submit'])){
        session_start();
        include 'db.php';
    
        $nama = ucwords($_POST['nama']);
        $user = $_POST['user'];
        $pass = MD5($_POST['pass']);
        $hp = $_POST['hp'];
        $email = $_POST['email'];
        $alamat = ucwords ($_POST['alamat']);
            
        if($nama AND $user AND $pass AND $hp AND $email AND $alamat){
        
            $insert = mysqli_query($conn, "INSERT INTO tb_admin (
                                    admin_name,
                                    username,
                                    password,
                                    admin_telp, 
                                    admin_email, 
                                    admin_address) 
                                    VALUES ('$nama','$user','$pass','$hp','$email','$alamat') ");

            if ($insert){
                echo '<script>alert("Register Succsessful. Please Login!")</script>';
                echo '<script>window.location="login.php"</script>';
                } else{
                echo '<script>alert("Register Failed!")</script>'.mysqli_error($conn);


                } 
        }else{
            echo '<script>alert("Data Can\'t be empty!")</script>';
        }


    }
?>
</div>
</body>
</html>