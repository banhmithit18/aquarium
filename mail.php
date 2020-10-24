<?php
    
    if(mail('tranphuoc4511@gmail.com', 'Xác nhận đặt tour', 'Bàn 1', "From: tranphuoc4511@gmail.com")){
        echo 'success';
    }else{
        echo 'false';
    }
 ?>