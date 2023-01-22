<?php

include 'config.php';

session_start();

// declare admin variable for inputted admin in session
$admin_id = $_SESSION['admin_id'];

// if inputted admin is not declared admin in session, throw to login page
if(!isset($admin_id)){
   header('location:admin_login.php');
};





// if add_product is clicked and submitted to DB, then....
if(isset($_POST['add_product'])){

// sends to post product name and price credentials to DB
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

// sends image to post to DB using $_FILES global var
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size']; 
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '/Applications/XAMPP/xamppfiles/htdocs/pizza_website/uploaded_img'.$image;


// selects product name from DB
   $select_product = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_product->execute([$name]);

// if product name is found, not save it 
   if($select_product->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }
// if product name is not found in DB, then post/save it in the DB
      else{
         $insert_product = $conn->prepare("INSERT INTO `products`(name, price, image) VALUES(?,?,?)");
         $insert_product->execute([$name, $price, $image]);
         // move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new product added!';
      }
   }

};




// deletes product after selecting image and id and remove from cart in DB as well
if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $delete_product_image ->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);

   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product -> execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart -> execute([$delete_id]);
   header('location:admin_products.php');


}; 


?>





<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>


<?php include 'admin_header.php'; ?>





<!-- section which has inputs to add product details -->
<section class="add-products">

  <h1 class="heading">add products</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" class="box" required maxlength="100" placeholder="enter product name">
    <input type="number" name="price" class="box" required min="0" max="1000000" placeholder="enter product price"
    onkeypress="if(this.value.length == 7) return false;">
    <input type="file" name="image" required accept="image/jpg, image/jpeg, image/png" class="box">
    <input type="submit" name="add_product" value="add product" class="btn">
  </form>

</section>








<!-- section which shows added product details -->
<section class="show-products">

  <h1 class="heading">products added</h1>

  <div class="box-container">

  <!-- connects to DB and products row to fetch/bring products inserted -->
  <?php
    $select_products = $conn->prepare('SELECT * FROM `products`');
    $select_products -> execute();
    if($select_products->rowCount() > 0){
       while($fetch_products = $select_products -> fetch(PDO::FETCH_ASSOC)){
  ?>

  <!-- fetches and brings to page to display registered products -->
  <div class="box">

   <div class="price">$<span><?= $fetch_products['price']; ?></span></div>
   <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="pizza">
   <div class="name"><?= $fetch_products['name']; ?></div>

   <div class="flex-btn">
      <a href="admin_product_update.php?update= <?= $fetch_products['id'];?>" class="option-btn">update</a>
      <a href="admin_products.php?delete= <?= $fetch_products['id'];?>" class="delete-btn"
      onclick="return confirm('delete this product?')">delete</a>
   </div>
   
  </div>

  <?php
   } }

   else{
      echo '<p class="empty"></p>';
   };
  ?>

  </div>
 
</section>









<script src="js/admin_script.js"></script>

</body>
</html>