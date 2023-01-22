<?php

include 'config.php';

session_start();

// declare admin variable for inputted admin in session
$admin_id = $_SESSION['admin_id'];

// if inputted admin is not declared admin in session, throw to login page
if(!isset($admin_id)){
   header('location:admin_login.php');
} 

else{

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>



<section class="dashboard">

  <h1 class="heading">dashboard</h1>
  <div class="box-container">




  <!-- 1) selects number of total pendings/ordered but not replied orders from DB -->
  <div class="box">
   <?php
     $total_pendings = 0;
     $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?" );
     $select_pendings->execute(['pending']);
     if($select_pendings -> rowCount() > 0){
       while($fetch_pendings = $select_pendings ->fetch (PDO::FETCH_ASSOC)){
         $total_pendings += $fetch_pendings['total_price'];
       }
     }
   ?>
   <!-- displays total pendings on dashboard and redirect to admin_order page -->
   <h3>$<?= $total_pendings; ?> /-</h3>
   <p> total_pendings </p>
   <a href="admin_orders.php" class="btn">see orders</a>
  </div>







  <!-- 2) selects number of total completed/replied orders from DB -->
  <div class="box">
   <?php
     $total_completes = 0;
     $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?" );
     $select_completes->execute(['completed']);
     if($select_completes -> rowCount() > 0){
       while($fetch_completes = $select_completes ->fetch (PDO::FETCH_ASSOC)){
         $total_completes += $fetch_completes['total_price'];
       }
     }
   ?>
   <!-- displays total completed/replied orders on dashboard and redirect to admin_order page -->
   <h3>$<?= $total_completes; ?> /-</h3>
   <p> completed orders </p>
   <a href="admin_orders.php" class="btn">see orders</a>
  </div>







  <!-- 3) selects total number of orders from DB -->
  <div class="box">
   <?php
     $select_orders = $conn->prepare("SELECT * FROM `orders`" );
     $select_orders->execute();
     $number_of_orders = $select_orders -> rowCount();
   ?>
   <!-- displays total number of orders on dashboard -->
   <h3><?= $number_of_orders; ?></h3>
   <p> orders placed </p>   <a href="admin_orders.php" class="btn">see orders</a>
  </div>






<!-- 4) selects total number of products from DB -->
<div class="box">
   <?php
     $select_products = $conn->prepare("SELECT * FROM `products`" );
     $select_products->execute();
     $number_of_products = $select_products -> rowCount();
   ?>
   <!-- displays total number of products on dashboard -->
   <h3><?= $number_of_products; ?></h3>
   <p> products added </p>
   <a href="admin_products.php" class="btn">see products</a>
  </div>








<!-- 5) selects total number of users from DB -->
<div class="box">
   <?php
     $select_users = $conn->prepare("SELECT * FROM `user`" );
     $select_users->execute();
     $number_of_users = $select_users -> rowCount();
   ?>
   <!-- displays total number of users on dashboard -->
   <h3><?= $number_of_users; ?></h3>
   <p> normal users </p>
   <a href="users_accounts.php" class="btn">see users</a>
  </div>









  <!-- 6) selects total number of admins from DB -->
  <div class="box">
   <?php
     $select_admins = $conn->prepare("SELECT * FROM `admin`" );
     $select_admins->execute();
     $number_of_admins = $select_admins -> rowCount();
   ?>
   <!-- displays total number of admins on dashboard -->
   <h3><?= $number_of_admins; ?></h3>
   <p> admin users </p>   <a href="admin_accounts.php" class="btn">see admins</a>
  </div>





   </div>
</section>




<script src="js/admin_script.js"></script>

</body>
</html>