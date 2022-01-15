<?php
include 'db.php';
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kay's Gallery </title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <!--header-->
<header>
            <div  class="container">
                    <h1><a href="dashboard.php">Kay's Gallery</a></h1>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="data-category.php">Data Category</a></li>
                    <li><a href="data-product.php">Data Product</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
    
    <!--section-->
    <div class="section">
    <div class="container">
        <h2>Profile</h2>
        <div class="box">
         <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" class ="input-control" value="<?php echo $d-> admin_name ?>"require>
            <input type="text" name="user" placeholder="Username" class ="input-control" value="<?php echo $d-> username ?>" require>
            <input type="text" name="hp" placeholder="No Telp" class ="input-control" value="<?php echo $d-> admin_telp ?>" require>
            <input type="email" name="email" placeholder="Email" class ="input-control" value="<?php echo $d-> admin_email ?>" require>
            <input type="text" name="alamat" placeholder="Alamat" class ="input-control" value="<?php echo $d-> admin_address ?>" require>
            <input type="submit" name="submit" value="Update Profile" class=btn>

            </form>
    <?php
        if(isset($_POST['submit'])){

            $nama = ucwords($_POST['nama']);
            $user = $_POST['user'];
            $hp = $_POST['hp'];
            $email = $_POST['email'];
            $alamat = ucwords ($_POST['alamat']);

        $update = mysqli_query($conn, "UPDATE tb_admin SET
                                admin_name = '".$nama."',
                                username = '".$user."',
                                admin_telp = '".$hp."',
                                admin_email = '".$email."',
                                admin_address = '".$alamat."'
                                WHERE admin_id = '".$d->admin_id."'");
        if($update){
            echo '<script>alert(" Update data berhasil ")</script>';
            echo '<script>window.location="profile.php"</script>';
        }
        else{
            echo 'Update gagal' .mysqli_error($conn);
        }

        }
    ?>
        </div>
    </div>
    </div>
    <div class="section">
    <div class="container">
        <h2>Change Password</h2>
        <div class="box">
         <form action="" method="POST">
            <input type="password" name="pass1" placeholder="New Password" class ="input-control" require>
            <input type="password" name="pass2" placeholder="Confirm Password" class ="input-control" require>
            <input type="submit" name="ubah_password" value="Change Password" class=btn>

            </form>
    <?php
        if(isset($_POST['ubah_password'])){

            $pass1 =($_POST['pass1']);
            $pass2 =($_POST['pass2']);
        
        if($pass2 != $pass1){
            echo '<script>alert("Password do not match")</script>';
        }
        else{
            $u_pass = mysqli_query($conn, " UPDATE tb_admin SET 
                                password = '".MD5($pass1)."'
                                WHERE admin_id = '".$d->admin_id."'");
        }
        if($u_pass){
            echo '<script>alert("Change Password Successfull")</script>';
            echo '<script>window.location="profile.php"</script>';
        }
        else{
            echo 'Failed to change password' .mysqli_error($conn);
        }

        }
    ?>
        </div>
    </div>
    </div>

    <!--footer-->
    <div class="footer">
    <div class="container">
    <small>copyright &copy; - 2022 Kay's Gallery. </small>
    </div>
    </div>
</body>
</html>