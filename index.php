<?php
    include 'header.php';
    include 'util/DBConnection.php';
?>
<?php
    function getEvent(){
        $open = OpenConnection();
        $sql = "SELECT * from event";
        $get = sqlsrv_query($open, $sql);
        while($event = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC)){
            $name = $event['eventname'];
            $detail = $event['eventdetail'];
            $time = $event['eventtime'];
            $img = $event['eventimg'];
            echo "
            <div class=\"container col-8 centerPage\" style=\"padding-left: 30px; margin-bottom: 25px;\">
                <div style=\"padding-left: 15px;\">
                    <span style=\"font-weight: bold; font-size: 18px; color:darkorange;\">$name</span>
                </div>
                <div style=\"display: flex;\">
                    <div style=\"width: 320px;\">
                        <img src=\"$img.jpg\" alt=\"\" style=\"width: 100%;\">
                    </div>
                    <div style=\"margin-left: 15px;\">
                        <span style=\"font-weight: bold\">$detail
                        </span>
                        <br>
                        <span style=\"font-weight: bold; font-size: 13px;\">
                            Time: $time
                        </span>
                        <br>
                        <div style=\"padding-left: 10px;\">
                            <span style=\"font-weight: bold; font-size: 13px;\"><a href=\"Ticket.php\"
                                    style=\"color: darkorange;\">Click here to buy tickets</a></span>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
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
    height: 550px;
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

#content {
    color: #000;
    font-weight: 500;
    font-style: normal;
    line-height: 1.5em;
    font-size: 19px;
}
</style>
<script>

</script>
<div style="height: auto;">
    <!-- panel-header. -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators" style="left: -1288px;" id="ol-choose">
            <li id="li1" data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="width: 15px;">
            </li>
            <li id="li2" data-target="#carouselExampleIndicators" data-slide-to="1" style="width: 15px;"></li>
            <li id="li3" data-target="#carouselExampleIndicators" data-slide-to="2" style="width: 15px;"></li>
            <li id="li4" data-target="#carouselExampleIndicators" data-slide-to="3" style="width: 15px;"></li>
        </ol>
        <div class="carousel-inner" id="background-header">
            <div class="carousel-item active" id="img1">
                <img class="d-block w-100" id="panel-header-1" src="images\panel-header\panel-header-1.jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item" id="img2">
                <img class="d-block w-100" id="panel-header-2" src="images\panel-header\panel-header-2.jpg"
                    alt="Second slide">
            </div>
            <div class="carousel-item" id="img3">
                <img class="d-block w-100" id="panel-header-3" src="images\panel-header\panel-header-3.png"
                    alt="Third slide">
            </div>
            <div class="carousel-item" id="img4">
                <img class="d-block w-100" id="panel-header-4" src="images\panel-header\panel-header-4.jpg"
                    alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- main -->
    <div style="background: url(images/blue-snow.png); height: 2000px; width: 100%;">
        <div class="container col-12 centerPage"
            style="background-color: red; display: flex; width: 100%; padding-left: 130px; top: -90px;">
            <!-- Open Time  -->
            <div class="col-2" id="margin-card">
                <div class="card middle">
                    <div class="front"
                        style="background-image: url(images/1.jpg); padding-top: 8px; padding-left: 7px;">
                        <div style="position: absolute;">
                            <img src="images/time_open_front.png" alt="" style="position: absolute; z-index: 2;">
                            <span
                                style="position: absolute; z-index: 3; top: 100px; font-family: Daftbrush; width: 200px; padding-left: 20px; font-size: 25px; color: white;font-style: normal;">
                                Opening Time
                            </span>
                        </div>

                    </div>
                    <div class="back" style="background-image: url(images/1.jpg);">
                        <div class="back-content middle">
                            <span
                                style="top: 109px;left: 100px; font-family: Daftbrush; width: 100%; font-size: 24px; color: white;font-style: normal;">
                                9 AM -
                            </span>
                            <span
                                style="top: 109px;left: 100px; z-index:11; font-family: Daftbrush; width: 200px; padding-left: 36px; font-size: 22px; color: white;font-style: normal;">
                                6 PM
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-2" id="margin-card">
                <div class="card middle" style="transform: rotate(-3deg);">
                    <div class="front"
                        style=" background-image: url(images/2.jpg); padding-top: 8px; padding-left: 7px;">
                        <div style="position: absolute;">
                            <img src="images/online-tickets_back.png" alt="" style="position: absolute; z-index: 2;">
                            <span
                                style="position: absolute; z-index: 3; top: 100px; font-family: Daftbrush; width: 200px; padding-left: 49px; font-size: 25px; color: white;font-style: normal;">
                                Tickets
                            </span>
                        </div>
                    </div>
                    <div class="back" style="background-color: green; background-image: url(images/2.jpg);">
                        <div class="back-content middle" style="position: initial;">
                            <div style="position: absolute;">
                                <img src="images/online-tickets_back.png" alt=""
                                    style="position:absolute; width: 166px; height: 166px; z-index: 10; left: 101px; top: 9px;">
                                <span
                                    style="position: absolute;top: 109px;left: 100px; z-index:11; font-family: Daftbrush; width: 200px; padding-left: 36px; font-size: 15px; color: white;font-style: normal;">
                                    <a href="buyticket.php" style="color: white;">Get your Tickets</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Directions -->
            <div class="col-2" id="margin-card">
                <div class="card middle">
                    <div class="front"
                        style="background-color: yellow; background-image: url(images/3.jpg); width: 100%;">

                        <div style="position: absolute;">
                            <img src="images/anfahrt_back.png" alt="" style="position: absolute; z-index: 2;">
                            <span
                                style="position: absolute; z-index: 3; top: 100px; font-family: Daftbrush; width: 200px; padding-left: 36px; font-size: 25px; color: white;font-style: normal;">
                                Directions
                            </span>
                        </div>
                    </div>
                    <div class="back"
                        style="background-color: yellow; background-image: url(images/3.jpg); width: 100%;">
                        <div class="back-content middle" style="position: initial;">
                            <div style="position: absolute;">
                                <img src="images/anfahrt_back.png" alt=""
                                    style="position:absolute; width: 166px; height: 166px; z-index: 10; left: 96px;">
                                <span
                                    style="position: absolute;top: 109px;left: 100px; z-index:11; font-family: Daftbrush; width: 200px; padding-left: 36px; font-size: 15px; color: white;font-style: normal;">
                                    <a href="Directions.php" style="color: white;">Route directions</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 4 -->
            <div class="col-2">
                <div class="card middle" style="transform: rotate(-3deg);">
                    <div class="front" style=" background-image: url(images/4.jpg);">

                    </div>
                    <div class="back" style="background-image: url(images/4.jpg);">
                        <div class="back-content middle">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container col-8 centerPage" id="main">
            <div class="container col-12 centerPage">
                <div style="text-align: center;">
                    <span
                        style="font-size: 48px;font-style: normal;font-weight: 600;letter-spacing: -1.92px;line-height: 48px;color: #00789a;margin-bottom: 15px;">Welcome
                        to Aquarium</span>
                </div>
                <div style="margin-bottom: 25px;">
                    <span id="content">
                        Aquarium is one of in Ho Chi Minh city best-known and most notable aquariums. Behind the
                        building’s
                        historic façade awaits an impressive diversity of species that few facilities in the world can
                        rival. The Aquarium not only houses numerous extraordinary fish, it is also home to hundreds of
                        impressive reptiles and insects.
                    </span>
                </div>
                <div style="height: 500px;">
                    <img src="images\covid.jpg" alt="" style="float: left; width: 97%;">
                </div>

            </div>

        </div>
        <div class="container col-8 centerPage" style="padding-left: 30px; height: 330px;">
            <div style="position: absolute;">
                <img src="images\ticket-online.jpg" alt="" style="position: absolute; z-index:1;">
                <span
                    style="position: absolute; z-index:1; top: 250px; width: 200px; font-size: 18px; font-weight: bolder; left: 20px;"><a
                        href="Ticket.php" style="color: white;">Buy online ticket</a></span>
            </div>
            <div style="position: absolute; left: 362px;">
                <img src="images\href_animal.jpg" alt="" style="position: absolute; z-index:1;">
                <span
                    style="position: absolute; z-index:1; top: 250px; width: 200px; font-size: 18px; font-weight: bolder; left: 182px;"><a
                        href="Animals.php" style="color: white;">Our Animal</a></span>
            </div>
        </div>
        <div class="container col-8 centerPage" style="padding-left: 30px;">
            <div style="margin-bottom:15px;">
                <span
                    style="font-size: 48px;font-style: normal;font-weight: 600;letter-spacing: -1.92px;line-height: 48px;color: #00789a;margin-bottom: 15px;">
                    Event
                </span>
            </div>
            <div style="margin-bottom: 25px;">
                <span id="content">
                    In water and on land, mysterious creatures are waiting to be discovered. Plunge into the fascinating
                    world of jellyfish, and get acquainted with some of the sea animal kingdom’s weirdest and most
                    wonderful shapes and colours.
                    The numerous events at Aquarium are an occasion to remember for children and adults alike.
                </span>
            </div>
        </div>
        <div id="event">
            <?php
                getEvent();
             ?>
            <!-- <div class="container col-8 centerPage" style="padding-left: 30px; ">
                <div style="padding-left: 15px;">
                    <span style="font-weight: bold; font-size: 18px; color:darkorange;">The mermaid appeared</span>
                </div>
                <div style="display: flex;">
                    <div style="width: 320px;">
                        <img src="images\nangtienca.jpg" alt="" style="width: 100%;">
                    </div>
                    <div style="margin-left: 15px;">
                        <span style="font-weight: bold">
                            Every Saturday at aquarium you will be able to see the mermaids swimming in the ocean
                            firsthand,
                            do not miss this special event.
                        </span>
                        <br>
                        <span style="font-weight: bold; font-size: 13px;">
                            Time: Saturday 10:00 AM | 11:00 AM | 1:00 PM | 2:00 PM | 3:00 PM every week
                        </span>
                        <br>
                        <div style="padding-left: 10px;">
                            <span style="font-weight: bold; font-size: 13px;"><a href="Ticket.php"
                                    style="color: darkorange;">Click here to buy tickets</a></span>
                        </div>

                    </div>
                </div>

            </div>
            <div class="container col-8 centerPage" style="padding-left: 30px; margin-top: 25px;">
                <div style="padding-left: 15px;">
                    <span style="font-weight: bold; font-size: 18px; color:darkorange;">Fish feeding show</span>
                </div>
                <div style="display: flex;">
                    <div style="width: 570px;">
                        <img src="images\8-.Cho-cá-ăn.jpg" alt="" style="width: 100%;">
                    </div>
                    <div style="margin-left: 15px;">
                        <span style="font-weight: bold">
                            Have you seen how much fun the colorful sea creatures are fed? Then head over to the
                            aquarium at the Aquarium to see for yourself how happy the adorable fishes are when they are
                            fed.
                            Don't forget the schedule of this program
                        </span>
                        <br>
                        <span style="font-weight: bold; font-size: 13px;">
                            Time: 8:00 AM | 1:00 PM | 4:00 PM every day
                        </span>
                        <br>
                        <div style="padding-left: 10px;">
                            <span style="font-weight: bold; font-size: 13px;"><a href="Ticket.php"
                                    style="color: darkorange;">Click here to buy tickets</a></span>
                        </div>

                    </div>
                </div>

            </div> -->
        </div>
    </div>
    <?php
    include 'footer.php';
?>