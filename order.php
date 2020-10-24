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
    session_start();
    $id =  $_SESSION['idacc'];
    $totalT = $_POST['totalT'];
    $time = $_SESSION['CR_time'];
    $open = OpenConnection();
    $sql_insert="INSERT INTO orders(accountid,price,date) values($id,$totalT,'$time'); SELECT SCOPE_IDENTITY()";
    $result=sqlsrv_query($open,$sql_insert);
    sqlsrv_next_result($result);
    sqlsrv_fetch($result);
    $idorder=sqlsrv_get_field($result,0);
    $_SESSION['idorder'] = $idorder;
 ?>