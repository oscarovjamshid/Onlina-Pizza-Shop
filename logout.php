<?php

include 'config.php';

// start session and delete it to remove all cache data
 session_start();
 session_unset();
 session_destroy();

//bring back user to admin_login page after log out
header('location:admin_login.php');
?>