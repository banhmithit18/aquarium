<?php
    include 'header.php';
    include 'util/DBConnection.php';
    session_start();
    if(empty($_SESSION['idacc'])){
        header('Location: model/LoginForm.php');
    }
 ?>
<?php
    date_default_timezone_set('Asia/ho_chi_minh');

    if(isset($_GET['ym'])){
        $ym = $_GET['ym'];
    }else{
        $ym = date('Y-m');
    }

    $timestamp = strtotime($ym, "-01");
    if($timestamp === false){
        $timestamp = time();
    }

    $today =date('Y-m-d', time());

    $html_title = date('Y/m', $timestamp);

    $prev = date('Y-m', mktime(0,0,0,date('m',$timestamp)-1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0,0,0,date('m',$timestamp)+1, 1, date('Y', $timestamp)));

    $day_count = date('t', $timestamp);

    $str = date('w', mktime(0,0,0,date('m',$timestamp), 1, date('Y', $timestamp)));

    $weeks = array();
    $week = '';

    $week .= str_repeat('<td></td>', $str);

    for( $day = 1; $day <= $day_count; $day++, $str++){
        if($day < 10){
            $date = $ym.'-0'.$day;
        }else{
            $date = $ym.'-'.$day;
        }
        
        if($today != $date){
            if($today > $date){
                $week .= "<td class='dayn'>".$day;
            }
            if($today < $date){
                $week .= "<td class='dayl' id='$day'>".$day;
            }
            
        }else{
            $week .= "<td class='dayl today' id='$day'>".$day;
        }
        $week .= '</td>';

        if($str %7 == 6 || $day == $day_count){
            if($day == $day_count){
                $week .= str_repeat('<td></td>', 6 - ($str % 7));
            }

            $weeks[] = '<tr>'.$week.'</tr>';

            $week = '';
        }
    }
    
 ?>

<?php
     function getTicket(){
        $open = OpenConnection();
        $query = "SELECT * from ticket";
        $ex = sqlsrv_query($open,$query);
        while($get = sqlsrv_fetch_array($ex, SQLSRV_FETCH_ASSOC)){
            $ticketname = $get['ticketname'];
            $ticketprice = $get['ticketprice'];
            echo"
               <tr>
                   <td style='font-weight: bolder; color: black;'>$ticketname</td>
                   <td style='font-weight: bolder; color: black;'>$ticketprice"."VND</td>
               </tr>
            ";
        }
     }
     
    function getTicket1(){
        $open = OpenConnection();
        $sql = "SELECT * from ticket";
        $get  = sqlsrv_query($open, $sql);
        while($ticket = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC)){
            $name = $ticket['ticketname'];
            $price = $ticket['ticketprice'];
            echo "
            <tr id='trdata'>
            <td class='name'>$name</td>
            <td class='price' id='price-$name'>$price</td>
            <td class='amount'>
                <input class='number' type='number' min=0 max=8 value='0' id=\"amount-$name\" >
            </td>
            <td class='total' id='total-$name'>0</td>
        </tr>
            ";
        }
    }
    
  ?>
<style>
.calendar {
    font-family: 'Noto Sans', sans-serif;
    padding-top: 100px;
}

th {
    height: 30px;
    text-align: center;
    font-weight: 700;
}

td {
    height: 50px;
}

.today {
    background-color: orange;
}

th:nth-of-type(7),
td:nth-of-type(7) {
    color: red;
}

th:nth-of-type(1),
td:nth-of-type(1) {
    color: red;
}

.dayn {
    background-color: rgba(108, 117, 125, 0.075);
}

.dayl:hover {
    background-color: #86ba24;
}

.time-block {
    height: 60px;
    width: 150px;
    background-color: #60C7DA;
    display: inline-block;
    margin-right: 20px;
    text-align: center;
    padding-top: 18px;
}

.time-block:hover {
    background-color: #86ba24;

}

#tbody-tickets tr td {
    color: black;
    font-weight: bolder;
}

#tbody-tickets tr {
    text-align: center;
}
</style>
<script>
$(document).ready(function() {
    $('.dayl').click(function() {
        var i;
        var event =
            "<div class='event'> <div class='event-desc'> HTML 5 lecture with Brad Traversy from Eduonix </div><div class='event-time'>1:00pm to 3:00pm</div></div>";
        for (i = 0; i <= 31; i++) {
            var d = $('.date').eq(i).text();
            if (d == 1) {
                $('.day').eq(i).append(event);
            }

        }
    });
    $('.dayl').click(function() {
        $('.dayl').not('.today').css('background-color', 'transparent');
        $('.today').css('background-color', 'orange');
        $(this).css('background-color', '#86ba24');
        var month = $('#ym').text();
        var day = $(this).attr('id');

        var md = month + "/" + day;
        var dt = new Date($.now());
        $.post("test.php", {
            day_visit: md
        }, function(data) {

        });
    });
    $('#click').click(function() {
        var alert = Cookies.get('email');
        alert(alert);
    });
});

function chooseTimeVisit($timechoose) {
    var time = $timechoose;
    $('#' + time).css('background-color', '#86ba24');

    $.post("time.php", {
        time: time
    }, function(data) {

    });
}
</script>
<div style="height: auto;">
    <div id="al">
        <img src="images\background.jpg" alt="" style="width: 100%;">
    </div>
    <div style="background: url(images/blue-snow.png); height: 1300px; width: 100%; padding-top: 50px;">
        <div class="container col-6" style="margin-bottom: 25px;">
            <span style="font-size: 42px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em; ">
                Ticket Prices
            </span>
        </div>
        <div class="container col-6">
            <table class="table" style="background-color: white;">
                <div class="">
                    <thead style="background-color: #60C7DA;">
                        <tr>
                            <th style="font-size: 21px; color: black;">Tickets</th>
                            <th style="font-size: 21px; color: black;">Price</th>
                        </tr>
                    </thead>
                </div>
                <tbody>
                    <?php
                        getTicket();
                     ?>
                </tbody>
            </table>
        </div>


        <!-- Calendar -->
        <div class="container col-6 calendar">
            <div>
                <span style="font-size: 30px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em; ">
                    Choose Days
                </span>
            </div>
            <div style="padding-left: 285px; display: flex;">
                <div style="margin-right: 20px;">
                    <span style="font-size: 20px; font-weight: bolder; ">
                        <a href="?ym=<?php echo $prev; ?>" style="color: red; text-decoration: none;">&lt;</a>
                    </span>
                </div>

                <span id="ym" style="font-size: 19px; font-weight: bolder;"><?php echo $html_title; ?></span>

                <div style="margin-left: 20px;">
                    <span style="font-size: 20px; font-weight: bolder; ">
                        <a href="?ym=<?php echo $next; ?>" style="color: red; text-decoration: none;">&gt;</a>
                    </span>
                </div>

            </div>
            <br>

            <div class="" style="height: 100px;">
                <table class="table table-bordered" style="height: 100%; background-color: white;">
                    <tr style="background-color: #60C7DA;">
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    <?php
                foreach($weeks as $week){
                    echo $week;
                }
             ?>
                </table>
                <br>
                <!-- time  -->
                <div id="time">
                    <div id='ticket-c'>
                        <div style='margin-bottom: 25px;'>
                            <span
                                style='font-size: 30px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em;'>
                                Choose a time to visit
                            </span>
                        </div>
                        <div style='display: block; margin-bottom: 30px;'>

                            <div class='time-block' onclick="chooseTimeVisit('8:00AM');" id='8:00AM'>
                                <span style='font-size: 15px; font-weight: bolder;' id='span'>
                                    8:00 AM
                                </span>
                            </div>
                            <div class='time-block' onclick="chooseTimeVisit('10:00AM');" id='10:00AM'>
                                <span style='font-size: 15px; font-weight: bolder;'>
                                    10:00 AM
                                </span>
                            </div>
                            <div class='time-block' onclick="chooseTimeVisit('1:00PM');" id='1:00PM'>
                                <span style='font-size: 15px; font-weight: bolder;'>
                                    1:00 PM
                                </span>
                            </div>
                            <div class='time-block' onclick="chooseTimeVisit('3:00PM');" id='3:00PM'>
                                <span style='font-size: 15px; font-weight: bolder;'>
                                    2:00 PM
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ticket  -->
                <div id="choose-ticket">
                    <span
                        style='font-size: 30px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em;'>
                        Choose your tickets
                    </span>
                    <div>
                        <table class='table' style='background-color: white;'>
                            <div class=''>
                                <thead style='background-color: #60C7DA;'>
                                    <tr>
                                        <th style='font-size: 16px; color: black;'>SELECT YOUR TICKETS</th>
                                        <th style='font-size: 16px; color: black;'>PRICE</th>
                                        <th style='font-size: 16px; color: black;'>AMOUNT</th>
                                        <th style='font-size: 16px; color: black;'>TOTAL</th>
                                    </tr>
                                </thead>
                            </div>
                            <tbody id='tbody-tickets'>
                                <?php
                                    getTicket1();
                                ?>
                                <tr id='trdata'>
                                    <td class='name'>Total</td>
                                    <td class='price'></td>
                                    <td class='amount'></td>
                                    <td class='totalT'>0</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div style='text-align: center;'>
                        <button id='pay' class='btn' style='background-color: #60C7DA;'>
                            <span style='font-weight: bolder;'>
                                Payment & Booking
                            </span>
                        </button>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<script>
$(document).ready(function() {
    $('#amount-Adult').change(function() {
        var quantity = parseInt($('#amount-Adult').val());
        var price = parseInt($('#price-Adult').text());
        $('#total-Adult').text(quantity * price);
        var total_adult = parseInt($('#total-Adult').text());
        var total_children = parseInt($('#total-Children').text());
        $('#trdata td.totalT').text(total_adult + total_children);
        if ($('#amount-Adult').val() < 0 || $('#amount-Adult').val() > 8) {
            alert('Maximum of 8 tickets');
            $('#total-Adult').text(0);
            $('#amount-Adult').val('0');
            $('#trdata td.totalT').text(0);
        }
    });
    $('#amount-Children').change(function() {
        var quantity = parseInt($('#amount-Children').val());
        var price = parseInt($('#price-Children').text());
        $('#total-Children').text(quantity * price);
        var total_adult = parseInt($('#total-Adult').text());
        var total_children = parseInt($('#total-Children').text());
        $('#trdata td.totalT').text(total_adult + total_children);
        if ($('#amount-Children').val() < 0 || $('#amount-Children').val() > 8) {
            alert('Maximum of 8 tickets');
            $('#total-Children').text(0);
            $('#amount-Children').val('0');
            $('#total').text(0);
            $('#trdata td.totalT').text(total_adult + 0);
        }
    });
    $('#pay').click(function() {
        $('.table tr#trdata').each(function(a, b) {
            var name = $('.name', b).text();
            alert(name);
            if (name == 'Total') {
                var totalT = parseInt($('#trdata td.totalT').text());
                $.post("GioHang.php", {
                        name: name,
                        totalT: totalT
                    },
                    function(data) {
                        window.location = "CartForm.php";
                    });
            } else {
                var price = $('.price', b).text();
                var amount = $('.amount input.number', b).val();
                var total = $('.total', b).text();
                // alert(name + price + amount + total);
                $.post("GioHang.php", {
                        name: name,
                        price: price,
                        amount: amount,
                        total: total
                    },
                    function(data) {
                        window.location = "CartForm.php";
                    });
            }

        });
    });


});
</script>

<?php
    include 'footer.php';
 ?>