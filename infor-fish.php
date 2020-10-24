<?php
include 'header.php';
include 'util\DBConnection.php';
?>
<?php
    if(isset($_GET['fishid'])){
        $fishid = $_GET['fishid'];
        $conn = OpenConnection();
        $select = "SELECT * FROM fish where fishname = '$fishid'";
        $sqlisset = sqlsrv_query($conn,$select);
        $isset = sqlsrv_fetch_array($sqlisset,SQLSRV_FETCH_ASSOC);

        $fishname= $_GET['fishid'];
        $conn = OpenConnection();
        //get location id
        $sqllocation = "SELECT count(imagesid) as quantity from images where imagename like '$fishname%'";
        $get = sqlsrv_query($conn,$sqllocation);
        $count = sqlsrv_fetch_array($get,SQLSRV_FETCH_ASSOC);
        
        if($isset){
            $fishid=$_GET['fishid'];
            $sql = "SELECT DISTINCT TOP 12 * FROM fish where fishname = '$fishid'";
            $getanimal = sqlsrv_query($conn,$sql);
            $infor = sqlsrv_fetch_array($getanimal,SQLSRV_FETCH_ASSOC);
    
            function getOrigin(){
                $fishname= $_GET['fishid'];
                $conn = OpenConnection();
                //get location id
                $sqllocation = "SELECT locationid  FROM fish where fishname = '$fishname'";
                $get = sqlsrv_query($conn,$sqllocation);    
                $location = sqlsrv_fetch_array($get,SQLSRV_FETCH_ASSOC);
    
                //get location name
                $locationid = $location['locationid'];
                $sql = "SELECT locationname  FROM location where locationid = '$locationid' ";
                $getanimal = sqlsrv_query($conn,$sql);
                $origin = sqlsrv_fetch_array($getanimal,SQLSRV_FETCH_ASSOC);
                echo $origin['locationname'];
            }

            
    
            function checkImg(){
                $fishname= $_GET['fishid'];
                $conn = OpenConnection();
                //get location id
                $sqlid = "SELECT fishid  FROM fish where fishname = '$fishname'";
                $get = sqlsrv_query($conn,$sqlid);    
                $fish = sqlsrv_fetch_array($get,SQLSRV_FETCH_ASSOC);
    
    
                $id= $fish['fishid'];
                $conn = OpenConnection();
                //get location id
                $sqlimg = "SELECT imagename  FROM images where fishid = '$id'";
                $get = sqlsrv_query($conn,$sqlimg);    
                $id = sqlsrv_fetch_array($get,SQLSRV_FETCH_ASSOC);
    
                $imgname = $id['imagename'];
                echo "<img src='uploads\.'0.jpg' alt='' style='height: 431px; width: 100%; margin-bottom: 20px;''>";
            }
            function getImg(){
                $fishname= $_GET['fishid'];
                // $img = "uploads\$fishname\.$fishname'.'0.jpg'";
                $img = "uploads/";
                $img .= $fishname;
                $img .= "/";
                $img .= $fishname;
                $img .= "0.jpg";
                echo "<img src='$img' alt='' style='height: 431px; width: 100%; margin-bottom: 20px;'>";
            }
        }else{
            header('Location: 404.php');
        } 
    }else{
        header('404.php');
    }
?>
<style>
.middle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: transparent;
}

.card {
    cursor: pointer;
    width: 185px;
    height: 160px;
    transform: rotate(2deg);
    border: 0px;
}

.front,
.back {
    width: 100%;
    height: 100%;
    overflow: hidden;
    backface-visibility: hidden;
    position: absolute;
    transition: transform .4s linear;
    box-shadow: 7px 8px 13px 0px;
}

.front {
    transform: perspective(600px) rotateY(0deg);
}

.back {
    transform: perspective(600px) rotateY(-180deg);
}

.card:hover>.front {
    transform: perspective(600px) rotateY(180deg);
}

.card:hover>.back {
    transform: perspective(600px) rotateY(0deg);
}

#margin-card {
    margin-right: 60px;
}

#main {
    margin-top: 100px;
    margin-bottom: 100px;

    border-radius: 15px;
    height: 500px;
    width: 100%;
    /* background: rgba(0, 0, 0, 0.2); */
}

#fish {
    border: 4px solid transparent;
    border-image: url('images/border-1.png') 4 4 4 repeat;
    background-image: url('images/panel-content.jpg');
    border-image-outset: 3px;
    height: 500px;
}

.slidershow {
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: absolute;
}
</style>
<div style="height: auto;">
    <div id="al">
        <img src="images\background.jpg" alt="" style="width: 100%;">
    </div>
    <div style="background: url(images/blue-snow.png); height: 1300px; width: 100%; padding-top: 50px;">
        <div class="container col-8 centerPage" id="main" style="">
            <div class="container" style="display:flex;">

                <!-- main -->
                <div class=" col-10">
                    <span
                        style=" font-size: 42px; font-weight: 500; color: #00789a; line-height: 1em; letter-spacing: -.04em;">
                        <?php
                            if(isset($_GET['fishid'])){
                                echo $infor['fishname'];
                                echo $infor['fishid'];
                                
                            }
                         ?>
                    </span>
                    <div class="col-10" style="padding-left: 0px; padding-top: 20px;margin-bottom: 20px;">
                        <span style="font-size: 20px;">
                            <?php
                            if(isset($_GET['fishid'])){
                                $fishnamefile = $infor['fishname'];
                                $detail = $infor['fishdetail'];
                                $file = 'uploads/'.$fishnamefile.'/'.$detail;
                                $myfile = fopen($file, "r") or die("Unable to open file!");
                                echo fread($myfile,filesize($file));
                                fclose($myfile);
                            }
                         ?>
                        </span>
                    </div>
                    <!-- fish -->
                    <div class="col-10" id="fish" style="height: auto;">
                        <div class="container-fluid" style="padding: 5px; padding-top: 10px;">
                            <?php
                                // getImg();
                             ?>
                            <!-- slide-img -->
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="background-header">
                                    <?php
                                        count1();
                                     ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <!-- --------------------------- -->
                            <div style="margin-bottom: 40px;">
                                <span style="font-size: 20px; font-weight: bold; color: white;">CHARACTERISTICS</span>
                            </div>
                            <div class="container" style="display: flex;">
                                <div class="col-6">
                                    <!-- origin -->
                                    <div>
                                        <div class="container">
                                            <span
                                                style="font-size: 18px; font-weight: bold; color: white;">Origin</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;">
                                                <?php
                                                if(isset($_GET['fishid'])){
                                                    getOrigin();
                                                }
                                                   
                                                 ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- habitat -->
                                    <div>
                                        <div class="container">
                                            <span
                                                style="font-size: 18px; font-weight: bold; color: white;">Haibitat</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                if(isset($_GET['fishid'])){
                                                    echo $infor['habitat'];
                                                }
                                                    
                                                 ?></span>
                                        </div>
                                    </div>

                                    <!-- Diet -->
                                    <div>
                                        <div class="container">
                                            <span style="font-size: 18px; font-weight: bold; color: white;">Diet</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                if(isset($_GET['fishid'])){
                                                    echo $infor['diet'];
                                                }
                                                    
                                                 ?></span>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <div class="container">
                                            <span
                                                style="font-size: 18px; font-weight: bold; color: white;">Status</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                   if(isset($_GET['fishid'])){
                                                    echo $infor['status'];
                                                }
                                                   
                                                 ?></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- right -->
                                <div class="col-6">

                                    <!-- Size -->
                                    <div>
                                        <div class="container">
                                            <span style="font-size: 18px; font-weight: bold; color: white;">Size</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                   if(isset($_GET['fishid'])){
                                                    echo $infor['size'].'cm';
                                                }
                                                    
                                                 ?></span>
                                        </div>
                                    </div>

                                    <!-- Weight -->
                                    <div>
                                        <div class="container">
                                            <span
                                                style="font-size: 18px; font-weight: bold; color: white;">Weight</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                    if(isset($_GET['fishid'])){
                                                        echo $infor['size'].'cm';
                                                    }
                                                    
                                                 ?></span>
                                        </div>
                                    </div>

                                    <!-- Brooding Time -->
                                    <div>
                                        <div class="container">
                                            <span style="font-size: 18px; font-weight: bold; color: white;">Brooding
                                                Time</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;">
                                                <?php
                                                        if(isset($_GET['fishid'])){
                                                            echo $infor['gestationperiod'];
                                                        }
                                                     ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Achievable -->
                                    <div>
                                        <div class="container">
                                            <span style="font-size: 18px; font-weight: bold; color: white;">Achievable
                                                age</span>
                                        </div>
                                        <div class="container">
                                            <span
                                                style="font-size: 15px;font-weight: 400; color: white; padding-left: 9px;"><?php
                                                    if(isset($_GET['fishid'])){
                                                        echo $infor['achievableage'];
                                                    }
                                                    
                                                 ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <!-- quảng cáo -->
                <!-- <div class="col-2">
                    <img src="images/logo-aquarium-final.png" alt="">
                </div> -->
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
?>