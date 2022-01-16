<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body id="bg-login">
    <div class="container">
        <h2> Login | Kay's Gallery </h2>
         <form method="POST" action="">
                <!--Form Input Username-->
                <label>Username</label><br>
                <input type="text" name="user"><br>
                <!--Form Input Password-->
                <label>Password</label><br>
                <input type="password" name="pass"><br>
                <!--Tombol Log In-->
                <button name="submit">Log in</button><br>
            
            </form> 

<?php
    if (isset($_POST['submit'])){
        session_start();
    include 'db.php';

    $user = mysqli_real_escape_string($conn, $_POST['user']); 
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $pass = MD5($pass);
    echo $pass;
    $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE
                                username = '$user' 
                                AND password = '$pass' ");
    if (mysqli_num_rows($cek) >0){
        $d = mysqli_fetch_object($cek);
        $_SESSION ['status_login'] = true;
        $_SESSION ['a_global'] = $d;
        $_SESSION ['id'] = $d->admin_id;
        echo '<script>window.location="dashboard.php"</script>';
    } else{
        echo mysql_error($conn);
        echo mysql_error($cek);
    }
        }
?>
</div>
</body>
</html>