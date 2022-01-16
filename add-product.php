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
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
        <h2>Add Data Product</h2>
        <div class="box">
         <form action="" method="POST" enctype="multipart/form-data">
             <select name="category" class="input-control" required>
                <option value="">--Select--</option>
                <?php
                $category = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                while($r = mysqli_fetch_array($category)){

                
                ?>
                <option value="<?php echo $r['category_id']?>"><?php echo $r['category_name']?></option>
                <?php } ?>
             </select>

             <input type="text" name="nama" class="input-control" placeholder="Product Name" require >
             <input type="text" name="price" class="input-control" placeholder="Price" require >
             <input type="file" name="image" class="input-control" require >
             <textarea name="desc" class="input-control" placeholder="Product Description" ></textarea><br>
             <select name="status" class="input-control">
                 <option value="">--Select--</option>
                 <option value="1">Available</option>
                 <option value="0">Not Available</option>   
             </select>
             <input type="hidden" name="submit" id="submit">
            <button type="submit" class="btn">Submit</button>
            </form>
        <?php
            if (isset($_POST['submit'])){

                //menampung inputan dari form
                $category   = $_POST['category'];
                $nama      = $_POST['nama'];
                $price      = $_POST['price'];
                $desc       = $_POST['desc'];
                $status     = $_POST['status'];

                //menampung data file yg di upload
                $filename = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                echo $tmp_name;
                

                $type1 = explode('.',$filename);
                $type2 = $type1[1];

                $newname = 'product'.time().'.'.$type2;
                echo '/product/' .$newname;

                //file yg diizinkan
                $allowed_file = array('jpg','jpeg','png','gif','apng');

                //validasi format file
                if(!in_array($type2, $allowed_file)){
                    echo '<script>alert("Format file not Allowed!")</script>';
                }
                else{
                //    move_uploaded_file($tmp_name, '/var/www/Commiss-php-native/product' .$newname );

                   if(move_uploaded_file($tmp_name,  $newname )){
                       echo 'berhasil terupload';
                   }
                   else{
                       echo 'gagal upload';
                   }
                //    $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(
                                    
                //                     '".$category."',
                //                     '".$nama."',
                //                     '".$price."',
                //                     '".$desc."',
                //                     '".$newname."',
                //                     '".$status."'
                                  

                //                     ) ");

                // $insert = mysqli_query($conn, "INSERT INTO tb_product (category_id, product_name, product_price, product_description, product_image, product_status) VALUES ('$category', '$nama', '$price', '$desc', '$newname', '$status')");
                //     if($insert){
                //         echo '<script language="javascript">alert("Add Data Product Sucessfull")</script>';
                //         echo '<script>window.location= "data-product.php"</script>';
                //     }
                //     else{
                //         echo 'Add Data Product Failed' .mysqli_error($conn);
                //     }
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
    <script>
        CKEDITOR.replace( 'desc' );
     </script>
</body>
</html>