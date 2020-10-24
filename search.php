<?php
function OpenConnection(){
    try{
        $serverName = "(local)";
        $connectionInfo = array("Database"=>"aquarium","UID"=>"sa","PWD"=>"123456"); // remember to change database name
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
function getListSearchName($fishname){
    // $fishname = $_POST['fishname'];
    $conn = OpenConnection();
    $query="SELECT *  FROM fish WHERE fishname like '$fishname%'" ;
    $get_list_animals = sqlsrv_query($conn,$query);
    while($row=sqlsrv_fetch_array($get_list_animals,SQLSRV_FETCH_ASSOC)){
    $fish_name = $row['fishname'];
    // $fishID = $row['fishid'];
    // $nameImg = $fish_name.'0';
    // $getImg = "SELECT * FROM images WHERE fishid = $fishID";

    $img = $fish_name;
    $img .= "0.jpg";
    echo "
    <div id='images'>
                <img class='fish' src='uploads/$fish_name/$img' alt=''>
                <span id='span-info'>
                    <a href='infor-fish.php?fishid=$fish_name'>$fish_name</a>
                </span>
            </div>
            ";
    }
}
function getListSearchType($type){
    $conn = OpenConnection();
    $query="SELECT * from  fish  join type on type.typeid = fish.typeid where type.typename = '$type'" ;
    $get_list_animals = sqlsrv_query($conn,$query);
    while($row=sqlsrv_fetch_array($get_list_animals,SQLSRV_FETCH_ASSOC)){
    $fish_name = $row['fishname'];
    // $fishID = $row['fishid'];
    // $nameImg = $fish_name.'0';
    // $getImg = "SELECT * FROM images WHERE fishid = $fishID";

    $img = $fish_name;
    $img .= "0.jpg";
    echo "
    <div id='images'>
                <img class='fish' src='uploads/$fish_name/$img' alt=''>
                <span id='span-info'>
                    <a href='infor-fish.php?fishid=$fish_name'>$fish_name</a>
                </span>
            </div>
            ";
    }
}
function getListSearchLocation($location){
    $conn = OpenConnection();
    $query="SELECT * from  fish  join location on location.locationid = fish.locationid where location.locationname = '$location'" ;
    $get_list_animals = sqlsrv_query($conn,$query);
    while($row=sqlsrv_fetch_array($get_list_animals,SQLSRV_FETCH_ASSOC)){
    $fish_name = $row['fishname'];
    // $fishID = $row['fishid'];
    // $nameImg = $fish_name.'0';
    // $getImg = "SELECT * FROM images WHERE fishid = $fishID";

    $img = $fish_name;
    $img .= "0.jpg";
    echo "
    <div id='images'>
                <img class='fish' src='uploads/$fish_name/$img' alt=''>
                <span id='span-info'>
                    <a href='infor-fish.php?fishid=$fish_name'>$fish_name</a>
                </span>
            </div>
            ";
    }
}
if(isset($_POST['fishname'])){
    $fishname = $_POST['fishname'];
    echo "<div class'list-animals' style='display: block;' id='list'>".getListSearchName($fishname);"</div>";
}else if(isset($_POST['type'])){
    $typename = $_POST['type'];
    echo "<div class'list-animals' style='display: block;' id='list'>".getListSearchType($typename);"</div>";
}
else if(isset($_POST['location'])){
    $location = $_POST['location'];
    echo "<div class'list-animals' style='display: block;' id='list'>".getListSearchLocation($location);"</div>";
}
 ?>