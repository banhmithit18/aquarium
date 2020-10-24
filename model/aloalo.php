<?php
session_start();
    if(isset($_SESSION['email']) && isset($_COOKIE['email']) && isset($_COOKIE['pass']) && isset($_COOKIE['checkRemember'])){
        $email = $_COOKIE['email'];
        $email2 = $_SESSION['email'];
        $pass = $_COOKIE['pass'];
        $checkRemember = $_COOKIE['checkRemember'];
        echo $email2;
    }
    $_SESSION['email'] = 'tranphuoc';
    $_SESSION['pass'] = '123';

 ?>