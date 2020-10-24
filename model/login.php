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
    
    
    if(empty($email = $_POST['email'])){
       echo ("<span style='float: left; color: red; font-size: 13px; font-weight: bold; display: block;'
        id='er-email'>Please enter your email !!</span>");
        
    }else{
        if(empty($pass = $_POST['pass'])){
            echo("<span style='float: left; color: red; font-size: 13px; font-weight: bold; display: block;'
            id='er-email'>Please enter your password !!</span>");
        }else{
            $query = "select * from account where email = '$email'";
            $conn = OpenConnection();
            $getUser = sqlsrv_query($conn, $query);
            if($row = sqlsrv_fetch_array($getUser, SQLSRV_FETCH_ASSOC)){
                $passmh = md5($pass);
                $email_data = $row['email'];
                $pass_data = $row['password'];
                $idacc = $row['accountid'];
                if($email == $email_data && $passmh == $pass_data){
                    if($_POST['checkRemember'] == "true"){
                        $checkRemember = $_POST['checkRemember'];
                        setcookie('email',$email, time() + (86400 * 30));
                        session_start();
                        $_SESSION['email'] = $email_data;
                        $_SESSION['idacc'] = $idacc;
                        setcookie('pass',$pass, time() + (86400 * 30));
                        setcookie('checkRemember',$checkRemember, time() + (86400 * 30));
                        $msg = "
                        <script>
                        window.location='../index.php';
                        </script>
                        ";
                    }else{
                        session_start();
                        $_SESSION['email'] = $email_data;
                        $_SESSION['idacc'] = $idacc;
                        $checkRemember = $_POST['checkRemember'];
                        setcookie('email',$email, time() - (86400 * 30));
                        setcookie('pass',$pass, time() - (86400 * 30));
                        setcookie('checkRemember',$checkRemember, time() - (86400 * 30));
                        $msg = "
                        <script>
                        window.location='../index.php';
                        </script>
                        ";
                    }
                   
                }else {
                    $msg = "<span id='er-mp' style='font-weight: bold; color: red; font-size: 14px;'>
                        Email or password incorrect !!
                    </span>";
                }
            }else{
                $msg = "<span id='er-mp' style='font-weight: bold; color: red; font-size: 14px;'>
                        Email or password incorrect !!
                    </span>";
            }
            
        }
    }
    if(isset($msg)){
        echo $msg;
    }
    
    
    
 ?>