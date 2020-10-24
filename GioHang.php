<?php
        $name = $_POST['name'];
    if($name != 'Total'){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $total = $_POST['total'];
        session_start();

        $_SESSION[$name.'name'] = $name;
        $_SESSION[$name.'price'] = $price;
        $_SESSION[$name.'amount'] = $amount;
        $_SESSION[$name.'total'] = $total;
    }else{
        session_start();
        $totalT = $_POST['totalT'];

        $_SESSION['totalTT'] = $totalT;
    }

    

 ?>