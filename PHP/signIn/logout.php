<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <title>Sign_In</title>
    <meta name="author" content="Conglt"/>
    <meta name="keyword" content="Ows"/>
    <link type="text/css" rel="stylesheet" href="logout.css"/>
    <?php
    if (isset($_POST["logout"])) {
        if (isset($_SESSION["email"])) {
            unset($_SESSION["email"]);
            header("Location: login.php");
        }
    }
    ?>
</head>
<body>
<div id="global">

    <div id="header">
        <div class="cloud">
            <img width="150px" height="auto" src="images/Logo.png" alt="cloud_meetting"/>
        </div>
    </div><!--End #header-->

    <div id="login">
        <h1>WELLCOME TO OWS.VN</h1>

        <form action="logout.php" method="post">
            <input type="button" name="logout" value="LogOut" />
        </form>
    </div><!--End #logout-->

    <div id="menu">
        <div id="table">
            <div class="feature">
                <h3 class="list_title">FEATURED NANODEGREE</h3>
                <ul>
                    <li><a href="#">Full Stack Web Developer</a></li>
                    <li><a href="#">iOS Developer</a></li>
                    <li><a href="#">Machine Learning Engineer Nanodegree by Google</a></li>
                    <li><a href="#">Intro Programing</a></li>
                    <li><a href="#">Senior Web Development Nanodegree bt Google</a></li>
                    <li><a href="#">Beginning iOS app development</a></li>
                    <li><a href="#">Data Analyst</a></li>
                </ul>
            </div><!--End .feature-->

            <div class="student">
                <h3 class="list_title">STUDENT RESOURCES</h3>
                <ul>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Help and FAQ</a></li>
                    <li><a href="#">Catalog</a></li>
                    <li><a href="#">Veteran Program</a></li>
                    <li><a href="#">Android App</a></li>
                    <li><a href="#">iOS app</a></li>
                </ul>
            </div><!--End .student-->

            <div class="udacity">
                <h3 class="list_title">UDACITY</h3>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">In The News</a></li>
                    <li><a href="#">Jobs @ Udacity</a></li>
                    <li><a href="#">Georgia Tech</a></li>
                    <li><a href="#">Udacity for Business</a></li>
                    <li><a href="#">Hire Graduates</a></li>
                    <li><a href="#">Student Success</a></li>
                </ul>
            </div><!--End .udacity-->

            <div class="logo">
                <img width="120px" height="auto" src="images/Logo.png" alt="Logo"/>
            </div><!--End #logo-->

        </div><!--End #table-->
    </div><!--End #menu-->

    <div id="footer">
        <div id="footer_title">
            NONADEGREE IS A TRADEMARK OF UDACITY &copy; 2011 - 2017 UDACITY, INC.
        </div><!--End #footer_title-->

        <div id="image">
            <img width="120px" height="auto" src="images/credit_cards.png" alt="cards"/>
        </div><!--End #image-->

    </div><!--End #footer-->

</div><!--End #global-->
</body>
</html>