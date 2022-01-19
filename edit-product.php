<?php
include 'db.php';
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
    if(mysqli_num_rows($product)== 0){
        echo '<script>window.location="data-product.php"</script>';  
    }
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
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
        <h2>Edit Data Product</h2>
        <div class="box">
         <form action="" method="POST" enctype="multipart/form-data">
             <select name="category" class="input-control" required>
                <option value="">--Select--</option>
                <?php
                $category = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                while($r = mysqli_fetch_array($category)){

                
                ?>
                <option value="<?php echo $r['category_id']?>"<?php echo ($r['category_id']== $p->category_id)?
                        'selected' : ''; ?>><?php echo $r['category_name']?></option>
                <?php } ?>
             </select>

             <input type="text" name="nama" class="input-control" placeholder="Product Name" value= "<?php echo $p-> product_name ?>" require >
             <input type="text" name="price" class="input-control" placeholder="Price" value= "<?php echo $p-> product_price ?>" require >
             <img src="product/<?php echo $p-> product_image ?>" width="200px" >
             <input type="hidden" name="foto" value="<?php echo $p-> product_image ?>" >
             <input type="file" name="image" class="input-control"  >
             <textarea name="desc" class="input-control" placeholder="Product Description" ><?php echo $p-> product_description ?></textarea><br>
             <select name="status" class="input-control">
                 <option value="">--Select--</option>
                 <option value="1" <?php echo ($p->product_status ==1)? 'selected' : ''; ?>>Available</option>
                 <option value="0" <?php echo ($p->product_status ==0)? 'selected' : ''; ?>>Not Available</option>   
             </select>
             <input type="hidden" name="submit" id="submit">
            <button type="submit" class="btn">Submit</button>
            </form>
        <?php
            if (isset($_POST['submit'])){

                //data inputan dari form
                $category   = $_POST['category'];
                $nama       = $_POST['nama'];
                $price      = $_POST['price'];
                $desc       = $_POST['desc'];
                $status     = $_POST['status'];
                $foto       = $_POST['foto'];

                //data gambar baru
                $filename = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $type1 = explode('.',$filename);
                $type2 = $type1[1];

                $newname = 'product'.time().'.'.$type2;

                //file yg diizinkan
                $allowed_file = array('jpg','jpeg','png','gif','apng');

                //jika admin ganti gambar
                if($filename != ''){
                    
               
                //validasi format file
                if(!in_array($type2, $allowed_file)){
                    echo '<script>alert("Format file not Allowed!")</script>';
               
                }else{
                    unlink('./product/'.$foto);
                    move_uploaded_file($tmp_name, './product/' .$newname);
                    $imagename = $newname;

                }
               
            }else{
                $imagename =$foto;
          } 
                //Query update data produk
            $update = mysqli_query($conn, "UPDATE tb_product SET
                                    category_id = '$category',
                                    product_name = '$nama',
                                    product_price = '$price',
                                    product_description = '$desc',
                                    product_image = '$imagename',
                                    product_status = '$status'
                                    WHERE product_id = '$p->product_id' ");

            if($update){
                echo '<script language="javascript">alert("Edit Data Product Successfull")</script>';
                echo '<script>window.location= "data-product.php"</script>';
            }else{
                echo 'Edit Data Product Failed' .mysqli_error($conn);
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