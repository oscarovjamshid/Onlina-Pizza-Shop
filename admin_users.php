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
   <title>users accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>





<script src="js/admin_script.js"></script>

</body>
</html>