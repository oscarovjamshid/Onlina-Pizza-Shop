
<!-- if inputted credentials are not found in db, show error msg  -->
<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<!-- header section like navbar for admin pages to display at top -->

<header class="header">

<section class="flex">

  <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

 <nav class="navbar">
  <a href="admin_page.php">home</a>
  <a href="admin_products.php">products</a>
  <a href="admin_orders.php">orders</a>
  <a href="admin_accounts.php">admin</a>
  <a href="users_accounts.php">users</a>
  <a href="admin_.php"></a>
</nav>

 <div class="icons">
  <div id="menu-btn" class="fas fa-bars"></div>
  <div id="user-btn" class="fas fa-user"></div>
 </div>

 
<div class="profile">
   <!-- we select inputted admin ID from DB to implement changes like update/reg/logout  -->
    <?php
      $select_profile = $conn->prepare('SELECT * FROM `admin` WHERE id = ?');
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>

   <!-- we selected inputted admin ID and named as fetch_profile -->
   <p><?= $fetch_profile['name']; ?></p> 
   <a href="admin_profile_update.php" class="btn">update profile</a>
   <a href="logout.php" class="delete-btn">logout</a>

   <div class="flex-btn">
    <a href="admin_login.php" class="option-btn">login</a>
    <a href="admin_register.php" class="option-btn">register</a>
   </div>

</div>


</section>
</header>

<!-- header section ends here -->
