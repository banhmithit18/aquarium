<?php
    include 'util/DBConnection.php';
 ?>
 <?php
    $dv = $_POST['day_visit'];
    session_start();
    $_SESSION['day_visit'] = $dv;
  ?>