<?php
    include 'header.php';
 ?>
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
    function getTicket(){
        $open = OpenConnection();
        $sql = "SELECT ticketname from ticket";
        $get = sqlsrv_query($open, $sql);
        
        while($ticket = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC)){
            if(isset($_SESSION[$ticket['ticketname'].'name'])){
                $name = $_SESSION[$ticket['ticketname'].'name'];
                $price = $_SESSION[$ticket['ticketname'].'price'];
                $amount = $_SESSION[$ticket['ticketname'].'amount'];
                $total = $_SESSION[$ticket['ticketname'].'total'];
                echo "
                    <tr id='trcart'>
                        <td class='name'>$name</td>
                        <td class='price' id='price-$name'>$price</td>
                        <td class='amount' id='amount-$name'><input  class='number' type=\"number\" id=\"1\" value=\"$amount\" min=\"1\" max=\"20\"/></td>
                        <td class='total' id='total-$name'>$total</td>
                    </tr>
                ";
            }
        }
    }
    function getCart(){
        if(isset($_SESSION['Adultname'])){
            if(isset($_SESSION['totalTT'])){
                $total = $_SESSION['totalTT'];
            }else{
                $total = $_SESSION['totalT'];
            }
            echo"
            <table class='table' style='background-color: white;'>
            <thead>
                <tr style='text-align: center;' >
                    <th scope=\"col\">TICKET</th>
                    <th scope=\"col\">PRICE</th>
                    <th scope=\"col\">AMOUNT</th>
                    <th scope=\"col\">TOTAL</th>
                </tr>
            </thead>
            <tbody>";
                getTicket();
            echo "
            <tr id='trcart'>
                        <td class='name'>Total</td>
                        <td></td>
                        <td></td>
                        <td class='totalT'>$total</td>
                    </tr>
                </tbody>
            </table>

            
            ";
        }
    }
 ?>
<style>
#trcart td {
    text-align: center;
}
</style>
<div id="al">
    <img src="images\background.jpg" alt="" style="width: 100%;">
</div>
<div style="background: url(images/blue-snow.png); height: 1300px; width: 100%;">
    <div class="container col-8 centerPage" style="padding-top: 50px;">
        <div style="text-align: center; margin-bottom: 25px;">
            <span style='font-size: 30px;font-weight: 500;color: #00789a;line-height: 1em;letter-spacing: -.04em;'>
                Your Cart
            </span>
        </div>
        <?php
            getCart();
        ?>
    </div>
    <div style='text-align: center;'><button class='btn btn-primary' id='btn-pay'>Payment</button></div>
</div>
<script>
$(document).ready(function() {
    $('#amount-Adult').change(function() {
        var quantity = parseInt($('#amount-Adult input.number').val());
        var price = parseInt($('#price-Adult').text());
        $('#total-Adult').text(quantity * price);
        var total_adult = parseInt($('#total-Adult').text());
        var total_children = parseInt($('#total-Children').text());
        $('#trcart td.totalT').text(total_adult + total_children);
        var totalTT = parseInt($('#trcart td.totalT').text());
        var name = 'Adult';
        $.post("amount.php", {
                name: name,
                quantity: quantity,
                total: total_adult,
                totalTT: totalTT
            },
            function(data) {});
        if ($('#amount-Adult').val() < 0 || $('#amount-Adult').val() > 8) {
            alert('Maximum of 8 tickets');
            $('#total-Adult').text(0);
            $('#amount-Adult').val('0');
            $('#trcart td.totalT').text(0);
        }
    });
    $('#amount-Children').change(function() {
        var quantity = parseInt($('#amount-Children input.number').val());
        var price = parseInt($('#price-Children').text());
        $('#total-Children').text(quantity * price);
        var total_adult = parseInt($('#total-Adult').text());
        var total_children = parseInt($('#total-Children').text());

        $('#trcart td.totalT').text(total_adult + total_children);
        var totalTT = parseInt($('#trcart td.totalT').text());
        var name = 'Children';
        $.post("amount.php", {
                name: name,
                quantity: quantity,
                total: total_children,
                totalTT: totalTT
            },
            function(data) {

            });
        if ($('#amount-Children').val() < 0 || $('#amount-Children').val() > 8) {
            alert('Maximum of 8 tickets');
            $('#total-Children').text(0);
            $('#amount-Children').val('0');
            $('#total').text(0);
            $('#trcart td.totalT').text(total_adult + 0);
        }
    });
    $('#btn-pay').click(function() {
        // alert($('.table tr#trcart').text());

        var dt = new Date();
        var month = dt.getMonth() + 1;
        var CR_time = dt.getFullYear() + "/" + month + "/" + dt.getDate() + " " + dt.getHours() + ":" +
            dt.getMinutes() + ":" + dt.getSeconds();
        $.post("getCurrentDT.php", {
                CR_time: CR_time
            },
            function(data) {

            });
        var totalT = parseInt($('.totalT').text());
        $.post("order.php", {
                totalT: totalT
            },
            function(data) {
               
            });
        
        $('.table tr#trcart').each(function(a, b) {
            var name = $('.name', b).text();
            if (name == 'Adult' || name == 'Children') {
                var price = $('.price', b).text();
                var amount = $('.amount input.number', b).val();
                var total = $('.total', b).text();
                $.post("Pey.php", {
                        name: name,
                        amount: amount
                    },
                    function(data) {
                        
                    });
            } else if(name == 'Total') {
                alert("Thank you bro ;))");
                window.location = "index.php";
                
            }

        });
    });


});
</script>
<?php
    include 'footer.php';
 ?>