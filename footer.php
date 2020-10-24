<style>
li {
    margin-right: 20px;
    font-weight: bold;
    font-size: 15px;

}

li a {
    color: white;
    /* text-decoration: none; */
}

li a:hover {
    color: white;
}
</style>
<footer>
    <div class="container-fluid"
        style="background: url('images/footerFond.png'); background-color: #00789a; height: 150px; border-bottom: solid 1px black;">
        <div class="container col-8 centerPage"
            style="height: 100%; align-items: center; padding-top: 14px; display :flex;">
            <div>
                <ul style="display: flex;">
                    <li><a href="">Organization</a></li>
                    <li><a href="">Careers</a></li>
                    <li><a href="">Partners</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">Press</a></li>
                    <li><a href="">Terms and Conditions</a></li>
                    <li><a href="">Data Protection</a></li>
                    <li><a href="">About</a></li>
                </ul>
            </div>
            <div>
                <img src="images\logo-aquarium-final.png" alt="">
            </div>
        </div>
    </div>
</footer>
<!-- <footer style="height: 100px;">

</footer> -->
<script src="js/jquery-3.5.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.icon-bars').click(function() {
            $('.icon-bars').toggleClass('active')
            $('nav').toggleClass('active')
        })
    })
    </script>

    <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        scrollFunction()
        scrollsFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("navbar-display").style.top = "0";
        } else {
            document.getElementById("navbar-display").style.top = "-130px";
        }
    }

    function scrollsFunction() {
        var currentScrollPos = window.pageYOffset;
        if (currentScrollPos == 0) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-130px";
        }
        prevScrollpos = currentScrollPos;
    }
    </script>