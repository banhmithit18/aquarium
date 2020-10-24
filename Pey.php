<?php
function OpenConnection(){
    try{
        $serverName = "(local)";
        $connectionInfo = array("Database"=>"AQUARIUM","UID"=>"sa","PWD"=>"123456"); // remember to change database name
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($conn)
        {
            //echo "Connection established";
            return $conn;
        }
        else
        {
            echo "Connection could not be established.</br>";
            die(print_r(sqlsrv_errors(),true));
        }

    }catch(Exception $e)
    {
        echo "Error";
    }return null;
}
function getIdTicket($name){
    $open = OpenConnection();
    
}
    session_start();
    $name = $_POST['name'];
    $id =  $_SESSION['idacc'];
    // $time_visit = $_SESSION['time_visit'];
    $time = $_SESSION['time_visit'];
    $open = OpenConnection();
    $sql_ticket = "SELECT ticketid from ticket where ticketname = '$name'";
    $get_ticket = sqlsrv_query($open,$sql_ticket);
    $id_ticket = sqlsrv_fetch_array($get_ticket, SQLSRV_FETCH_ASSOC);

    $idorder = $_SESSION['idorder'];
    $idtic = $id_ticket['ticketid'];
    $quantity = $_POST['amount'];
    $calendar = $_SESSION['time_visit'];
    $day_visit = $_SESSION['day_visit'];

    $timevisit = $day_visit." ".$calendar;
    $query="INSERT INTO orderdetail(orderid,ticketid,quantity,timevisit,message) values($idorder,$idtic,$quantity,'$timevisit',null)";
    $get = sqlsrv_query($open, $query);
 ?>