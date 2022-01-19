<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
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
                    <h1><a href="index.php">Kay's Gallery</a></h1>
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
        <h2>Category</h2>
        <div class="box">
        <p><a href="add-category.php">(+) Add Category</a></p>
        <table cellspacing="0" border='1' class="table">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Category</th>
                    <th width="120px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no =1;
                    $category = mysqli_query($conn, "SELECT *FROM tb_category ORDER BY category_id DESC ");
                    if(mysqli_num_rows($category)>0 ){
                    while($row = mysqli_fetch_array($category)){

                    
                ?>
                <tr>
                    <td> <?php echo $no++ ?> </td>
                    <td> <?php echo $row['category_name'] ?> </td>
                    <td>
                       <a href="edit-category.php?id=<?php echo $row['category_id']?>">Edit</a> ||
                        <a href="delete-category.php?idc=<?php echo $row['category_id']?>"
                        onclick="return confirm('Are You sure want to delete this Category?')" > Delete </a> 
                    </td>
                </tr>
                <?php }}else{?>
                    <tr>
                    <td colspan="3">No Data</td>
                    </tr>

              <?php  } ?>
            
            </tbody>
        </table>
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