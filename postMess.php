<?php
    $email = $_POST['email'];
    $mess = $_POST['mess'];

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

    $open = OpenConnection();
    $sql = "INSERT into messenger values('$email', '$mess', 1)";
    $get = sqlsrv_query($open, $sql);
    if(mail("$email","NO REPLY", "$mess",)){

    }
    $subject = "(NO REPLY) KPN_Aquarium";
    $body = "Respond: $mess \n"."Thanks for feedback";
    $headers = "From: tranphuoc4511@gmail.com";

    if(mail("$email", $subject, $body, $headers)){
        echo "success";
    }else{
        echo "fail";
    }
 ?>