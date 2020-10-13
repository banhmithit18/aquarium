<?php
    include 'header.php';
?>

</style>
<script>
$(document).ready(function() {
    $('#icon-captcha').click(function() {
        var i;
        var code = "";
        for (i = 0; i <= 5; i++) {
            var a = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B',
                'N',
                'M', 'Q', 'W', 'E', 'R', 'T',
                'Y', 'U', 'I', 'O', 'P', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'q', 'w', 'e',
                'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k',
                'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm'
            ];
            var a = a[Math.floor(Math.random() * 62)];
            code = code + a;
        }
        $('#captcha').val(code);
    });
    $('#submit').click(function() {
        var code = $('#captcha').val();
        var enter = $('#enter-captcha').val();
        if (code == enter) {
            alert(code);
        }
    });

});
</script>
<style>
    input[type=text]:disabled {
    background: #dddddd;
}
</style>
<div style="height: auto;">
    <div id="al">
        <img src="images\background.jpg" alt="" style="width: 100%;">
    </div>
    <div style="background: url(images/blue-snow.png); height: 1300px; width: 100%; padding-top: 50px;">
        <div class="container col-6 centerPage"
            style="background: rgba(0, 0, 0, 0.5); padding-bottom: 50px; padding-top: 50px; border-radius: 5px; margin-bottom:50px;">
            <div class="container col-8 centerPage">
                <div class="col-6">
                    <span style="font-weight: bold; font-size: 25px;">Contact Form</span>
                </div>
                <div>
                    <span style="color: white;">
                        Do you have any questions relating to our offers or special topics? The Aquarium welcomes
                        comments, advice and questions. You may find that the answer to certain issues has already been
                        dealt with in the FAQs section of our website. If your question has not been answered, then you
                        can
                        use the contact form below to send us a message.
                    </span>
                </div>
            </div>
            <br>
            <div class="container col-8 centerPage">
                <form action="">
                    <div id="line-email" style="display :flex; margin-bottom: 16px;">
                        <div style="margin-right: 20px; width: 110px;">
                            <span>Solutation</span>
                            <select class="form-control" name="" id="">
                                <option value=""></option>
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>
                        <div style=" width: 300px;">
                            <span>Surname</span>
                            <input type="text" class="form-control" id="emailorusername" name="emailorusername">
                        </div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <span>First name</span>
                        <input type="text" class="form-control" id="emailorusername" name="emailorusername"
                            style="width: 94%;">
                    </div>
                    <div style="margin-bottom: 16px;">
                        <span>Email</span>
                        <input type="email" class="form-control" id="emailorusername" name="emailorusername"
                            style="width: 94%;">
                    </div>
                    <div style="margin-bottom: 16px;">
                        <span>My message</span>
                        <textarea class="form-control" name="" id="" cols="26" rows="10" style="width: 94%;"></textarea>
                    </div>
                    <div>
                        <span>I am interested in</span>
                        <select class="form-control" name="" id="" style="width: 94%;"></select>
                    </div>
                    <div id="line-email" style="display :flex; margin-bottom: 16px;">
                        <div style="margin-right: 20px; width: 110px;">
                            <span>Captcha</span>
                            <div style="display: flex;">
                                <input type="text" id="captcha" class="form-control" readonly="readonly" disabled="disabled" value=""
                                    style="font-weight: bold; font-size: 15px; width: 96px;">
                                <div style="padding-top: 5px; padding-left: 10px;" id="icon-captcha">
                                    <span><i class="fas fa-sync-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div style=" width: 300px;">
                            <span>Enter information from captcha</span>
                            <input type="text" class="form-control" id="enter-captcha" name="enter-captcha">
                        </div>
                    </div>
                    <div>
                        <input type="button" class="btn btn-primary" name="" id="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include 'footer.php';
?>