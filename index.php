<?php
    include 'db.php';
    session_start();
    $contact = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($contact);
    
    
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
                    <li><a href="product.php">Product</a></li>
                    <?php if($_SESSION['status_login'] == true){
                    echo '<li><a href="dashboard.php">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                    }else { 
                    echo '<li><a href="login.php">Login</a></li>';
                    
                    
                    }?>
                </ul>
            
            </div>
        </header>
        
    <!--search-->
    <div class="search">
        <div class="container">
         <form action="product.php">
        <input type="text" name="search" placeholder="Search Product">
        <input type="submit" name="src" values="Search Product">
         </form>
        </div>
    </div>

    <!--category-->
    <div class="section">
        <div class="container" >
        <h3>Category</h3>
        <div class="box">
        <?php
                $category = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if (mysqli_num_rows($category) > 0){
                    while($c = mysqli_fetch_array($category)){
                
                ?>
                <a href="product.php?category=<?php echo $c['category_id'] ?>">
                <div class="col-5">
                    <img src="img/lol.jpg" width="50px" >
                    <p><?php echo $c['category_name'] ?></p>
                </div>
                </a>
                <?php }}else{ ?>
                    <p>No Category</p>
                <?php } ?>             
        </div>
        </div> 
    </div>
                
    <!--new product-->
    <div class="section">
        <div class="container">
            <h3>New Product</h3>
            <div class="box">
                <?php
                $product=mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_id DESC LIMIT 8");
                if(mysqli_num_rows($product)> 0){
                    while($p=mysqli_fetch_array($product)){
                ?>
                <a href="product-detail.php?id=<?php echo $p['product_id'] ?>">
                <div class="col-4">
                    <img src="product/<?php echo $p['product_image'] ?>">
                    <p class="name"><?php echo $p['product_name'] ?></p>
                    <p class="price"> Started From $.<?php echo $p['product_price'] ?></p>
                </div>
                 </a>
                <?php }}else{?>

                    <p>No Product</p>
                <?php }?>    
            </div>
        </div>
    </div>

    <!--footer-->
    <div class="footer">
        <div class="container">
            <h4>Address</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>Phone</h4>
            <p><?php echo $a->admin_telp ?></p>

            <small>Copyright &copy; 2022 - Kay's Gallery.</small>
        </div>
    </div>
</body>
</html>