<?php
    if(isset($_COOKIE['email']) && isset($_COOKIE['pass']) && isset($_COOKIE['checkRemember'])){
        $email = $_COOKIE['email'];
        $pass = $_COOKIE['pass'];
        $checkRemember = $_COOKIE['checkRemember'];
    }
 ?>
<!doctype html>
<htmllang="en">

    <head>
        <meta charset="utf-8">
        <title>The HTML5 Herald </title>
        <meta name="description" content="The HTML5 Herald">
        <meta name="author" content="SitePoint">

        <link rel="stylesheet" href="/aquarium/css/bootstrap.css">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <!-- <link rel="stylesheet" href="..\css\mysite.css"> -->
    </head>
    <style>
    body {
        background: url('../images/shark.jpg');
        background-repeat: no-repeat;
        background-size: 100%;
    }

    #background-form {
        background: rgba(0, 0, 0, 0.5);
        border-radius: 15px;
        height: 600px;
        text-align: center;
        padding-top: 43px;
    }
    </style>
    <script>
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>

    <body>
        <script>
        $(document).ready(function() {
            $('#login').click(function() {
                $('#er-email').remove();
                $('#er-pass').remove();
                $('#er-mp').remove();
                var email = $('#emailorusername');
                var pass = $('#pass');
                var checkRemember = $('#checkRemember').prop('checked');
                $.post("login.php", {
                    email: email.val(),
                    pass: pass.val(),
                    checkRemember: checkRemember
                }, function(data) {
                    if (email.val() == "") {
                        $("#line-email").append(data);
                    } else {
                        if (pass.val() == "") {
                            $("#line-pass").append(data);
                        } else {
                            $('#ketqua').html(data);
                        }
                    }

                });
            });
            $('#register').click(function() {
                window.location.href = "RegisterForm.php";
            });
        });
        </script>
        <div class="container-fluid firts" style="padding-top: 100px;">
            <div class="container col-4 centerPage" id="background-form">
                <span style="text-align:center; color: white;">
                    <h3>
                        Login
                    </h3>
                </span>
                <br>
                <div class="container col-11 centerPage">
                    <div id="line-email">
                        <input type="text" class="form-control" id="emailorusername" name="emailorusername" <?php
                                if(isset($_COOKIE['email'])){
                                    echo "value = '".$_COOKIE['email']."'";
                                }else{
                                    echo "value placeholder='Email'";
                                }
                             ?>>
                    </div>
                    <br>

                    <div id="line-pass">
                        <input type="password" class="form-control" id="pass" name="pass" style="margin-bottom: 10px;" <?php
                                if(isset($_COOKIE['pass'])){
                                    echo "value = '".$_COOKIE['pass']."'";
                                }else{
                                    echo "value placeholder='Password'";
                                }
                             ?>>

                    </div>
                    <div>
                        <br>
                    <div style="float: left;">
                            <input type="checkbox" style="text-align: center;" id="checkRemember" <?php
                                    if(isset($_COOKIE['checkRemember'])){
                                        if($_COOKIE['checkRemember'] == "true"){
                                            echo "checked";
                                        }else{
                                            echo "";
                                        }
                                    }else{
                                        echo "";
                                    }
                                 ?>>
                            <span style="color: white; font-size: 14px;">Remember Login</span>
                        </div>
                        <div>
                            <input type="checkbox" onclick="myFunction()">
                            <span style="color: white; font-size: 14px;">Show Password</span>
                        </div>
                    </div>
                    <br>
                    <div id="ketqua">

                    </div>
                    <br>

                    <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" id="login"
                            style="width: 80%; font-weight: bold;">Login</button>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button type="button" class="btn btn-warning" id="register"
                            style="width: 80%; font-weight: bold;">Register</button>
                    </div>
                </div>
            </div>
        </div>
        <script>

        </script>
    </body>

    </html>