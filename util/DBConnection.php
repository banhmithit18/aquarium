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
function checkExist($table,$column,$value)
{
    $conn = OpenConnection();
    $query = "";
    if(is_string($value)){
        $query = "SELECT $column FROM $table WHERE $column ='$value'";
    }
    else
    {
        $query = "SELECT $column FROM $table WHERE $column =$value";
    }
    $check = sqlsrv_has_rows(sqlsrv_query($conn,$query));
    
    if ($check)
    {
        return true;
    }
    else{
       return false;
    }
}
function getTableValues($stmt,$page,$columnname)
{
    $conn = OpenConnection();
    $query = sqlsrv_query($conn,$stmt);
    $i = 0;
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
        echo  "<tr>";
        echo "<td>$i</td>";
       
        foreach ($columnname as $key)
    {
        
        echo "<td>  $row[$key] </td>";
        
    }
    $fishid = $row['fishid'];
    if ($row['fishstatus'] == 1 )
        {
            echo  "<td>  <input class=\"form-check-input ml-3 check\" type=\"checkbox\"value=\"option1\" id =\"$fishid\" name=\"checkbox\" aria-label=\"...\" checked style='position: inherit;'>
        </td>";
        }
        else
        {echo  "<td>     <input class=\"form-check-input ml-3 check\" type=\"checkbox\"value=\"option1\" id =\"$fishid\" name=\"checkbox\" aria-label=\"...\" style='position: inherit';>
            </td>";}
    
        echo "<td>
        <a href=\"#myModal\" class=\"edit fish\" value=\"$i\"  data-toggle=\"modal\"><i class=\"material-icons\" value=$\"fishid\"  data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>
        <a href=\"#deleteEmployeeModal\" class=\"delete fish\" data-val=$i  data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>
            </td>";
        echo "</tr>";
        $i++;
    }

    
}
function getSelectedItems($table,$column)
{
    $returnArr = array();
    $conn = OpenConnection();
    $stmt = "Select $column from $table";
    $query = sqlsrv_query($conn, $stmt);
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
        array_push($returnArr,$row[$column]);
    }
    return $returnArr;

}
function getId($table,$val)
{
    $conn = OpenConnection();
    $columnname = $table."id";
    $valcolumnname = $table."name";
    $stmt = "SELECT $columnname FROM $table WHERE $valcolumnname = '$val'";
    $query = sqlsrv_query($conn, $stmt);
    $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    
        return $row[$table."id"];
    
}
function Create($item ){
    try{
        $conn = OpenConnection();
        $tableName = get_class($item); // get class name
        $query = "INSERT INTO $tableName (";
        $fields  = get_object_vars($item);
        $class = new ReflectionClass($tableName);
        $properties = $class->getProperties(); // get class properties
        foreach ($properties as $property) {
            // skip inherited properties
            if ($property->getDeclaringClass()->getName() !== $class->getName()) {
              continue;
            }
    
            $classProperties[] = $property->getName();
          }
        
        foreach($classProperties as $columnitem)
        {
            $query .= $columnitem .",";

        }
        $query = substr($query,0,strlen($query)-1);
        $query .= ") VALUES(";
        foreach($fields as $fileditem)
        {
            if (is_string($fileditem))
            {
                $query .= "'$fileditem'".",";
            }
            else
            {
                $query .= $fileditem.",";
            }
        }
        $query = substr($query,0, strlen($query) -1);
        $query .= ")";
        $check = sqlsrv_query($conn,$query);
        if ($check == 0)
        {
            return false;
        }
        else{
           return true;
        }

    }
    catch (Exception $e)
    {
        echo("Error");
    }
}
function getListAnimals(){
    $conn = OpenConnection();
    $query="SELECT * FROM fish";
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
                    <span
                        id='span-info'>
                        <a href='infor-fish.php?fishid=$fish_name'>$fish_name</a>
                    </span>
                </div>
                ";
    }
}
function getListSearch($fishname){
    // $fishname = $_POST['fishname'];
    $conn = OpenConnection();
    $query="SELECT * FROM fish WHERE fishname like 'ca1%'";
    $get_list_animals = sqlsrv_query($conn,$query);
    while($row=sqlsrv_fetch_array($get_list_animals,SQLSRV_FETCH_ASSOC)){
    $fish_name = $row['fishname'];
    // $fishID = $row['fishid'];
    // $nameImg = $fish_name.'0';
    // $getImg = "SELECT * FROM images WHERE fishid = $fishID";

    $img = $fish_name;
    $img .= "0.jpg";
    echo "
    <div id='images' >
                <img class='fish' src='uploads/$fish_name/$img' alt=''>
                <span
                    style='font-size: 18px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em; '>
                    <a href='infor-fish.php?fishid=$fish_name'>$fish_name</a>
                </span>
            </div>
            ";
    }
}
function count1(){
    $fishname= $_GET['fishid'];
    $conn = OpenConnection();
    //get location id
    $sqllocation = "SELECT count(imagesid) as quantity from images where imagename like '$fishname%'";
    $get = sqlsrv_query($conn,$sqllocation);
    $count = sqlsrv_fetch_array($get,SQLSRV_FETCH_ASSOC);
    
    // $img = "uploads\$fishname\.$fishname'.'0.jpg'";
    $img = "uploads/";
    $img .= $fishname;
    $img .= "/";
    $img .= $fishname;
    echo "<img src='$img' alt='' style='height: 431px; width: 100%; margin-bottom: 20px;'>";

    $i = 0;
    for($i = 0; $i < $count['quantity']; $i++){
        if($i == 0){
            echo "
        <div class='carousel-item active' id='img$i'>
            <img class='d-block w-100' id='panel-header-$i'
            src='$img$i.jpg' alt='First slide' style='height: 442px;'>
        </div>
        ";
        }else{
            echo "
        <div class='carousel-item' id='img$i'>
            <img class='d-block w-100' id='panel-header-$i'
            src='$img$i.jpg' alt='First slide' style='height: 442px;'>
        </div>
        ";
        }
        
        
    }
} 

 ?>