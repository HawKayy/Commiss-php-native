<?php
    error_reporting(0);
    include 'db.php';
    $contact = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($contact);

    $product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($product);
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
                </ul>
            </div>
        </header>
        
    <!--search-->
    <div class="search">
        <div class="container">
         <form action="product.php">
        <input type="text" name="search" placeholder="Search Product" value="<?php echo $_GET['search'] ?>">
        <input type="hidden" name="category" value="<?php echo $_GET['category'] ?>">
        <input type="submit" name="src" values="Search Product">
         </form>
        </div>
    </div>

    <!--product detail-->
    <div class="section">
        <div class="container">
            <h3>Product Detail</h3>
            <div class="box">
            <div class="col-2">
                <img src="product/<?php echo $p->product_image ?>" width="100%">
            </div>
            <div class="col-2">
                <h3><?php echo $p->product_name ?></h3>
                <h4>Started From $.<?php echo $p->product_price ?></h4>
                <p><b>Desc</b> : <br>
                <?php echo $p->product_description ?>  
                </p>
                <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Heloo... I'm interested with your Drawing" style="color:#2979FF;" target="_blank">
                Contact Me via Whatsapp here!
                    <img src="img/IWA.png" width="40px">
                </a>
            </p>   
            </div>
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