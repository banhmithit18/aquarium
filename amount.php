<?php
session_start();
    $name = $_POST['name'];

    if(isset($_POST['totalTT'])){
        $_SESSION[$name.'amount'] = $_POST['quantity'];
        $_SESSION[$name.'total'] = $_POST['total'];
        $_SESSION['totalTT'] = $_POST['totalTT'];
    }
    // echo $_SESSION['totalT'];

 ?>