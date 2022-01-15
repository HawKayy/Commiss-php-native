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
        <h2>Add Data Category</h2>
        <div class="box">
         <form action="" method="POST">
            <input type="text" name="name" placeholder="Category Name" class ="input-control" require>
            <input type="submit" name="submit" value="Submit" class=btn>
            </form>
        <?php
            if (isset($_POST['submit'])){

                $name = ucwords($_POST['name']);

                $insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES ('$name')");
            if ($insert){
                echo '<script>alert("Add Data Category Successfull")</script>';
                echo '<script>window.location="data-category.php"</script>';
            }
            else{
                echo 'Failed to Add Data Category' .mysqli_error($conn);
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