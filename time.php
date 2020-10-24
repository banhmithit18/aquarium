<?php
    session_start();
    $time = $_POST['time'];
    $_SESSION['time_visit'] = $time;
    
 ?>
