<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="author" content="Conglt"/>
    <meta name="keyword" content="Ows"/>
    <link type="text/css" rel="stylesheet" href="style.css"/>

    <!--Code PHP-->
    <?php
    if (isset($_POST["login"])) {
        // Ket noi PHP voi MySql
        $conn = mysqli_connect("localhost", "root", "", "ows");

        //Khong ket noi duoc thi dung chuong trinh
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Test input
        function test_input($data)
        {
            $data = trim($data); // loai bo dau \
            $data = stripslashes($data);    // xoa khoang trang, tab, xuong dong
            $data = htmlspecialchars($data);
            return $data;
        }

        //Khi click vao button sign in
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $password = md5($password);

        //Neu nguoi dung nhap thieu
        if ($email == NULL || $password == NULL) {
            echo "Email or password is not have";
            // reload lai trang
            $page = $_SERVER['PHP_SELF'];
            $sec = "0.2";
            header("Refresh: $sec; url=$page");
            return;
        }

        $sql = "SELECT email, password FROM user WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        // neu dung email va mat khau
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo 'WELLCOME';

                // Luu session
                $_SESSION["email"] = $row["email"];

                // Chuyen sang trang logout
                header("Location:logout.php");
            } else {
                echo 'Email or password is incorrect';
                // reload lai trang
                $page = $_SERVER['PHP_SELF'];
                $sec = "0.5";
                header("Refresh: $sec; url=$page");
            }
        }
        mysqli_close($conn);
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
        <div id="sign_in">
            <div class="signIn_title">
                Sign in
            </div><!--End #sign_in-->

            <form action="login.php" method="post">
                <div class="info">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>

                <div class="info">
                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>

                <div id="forgot">
                    Forgot your password?
                </div><!--End #forgot-->

                <div id="button_signIn">
                    <input type="submit" name="login" value="SIGN IN"/>
                </div><!--End #button_signIn-->

            </form> <!-- End FORM -->

            <div id="Or">
                <div class="line1">
                    <hr/>
                </div>

                <div class="or">Or</div>

                <div class="line2">
                    <hr/>
                </div>
            </div><!--End #Or-->

            <div class="Other_login">
                <div class="icon">
                    <a href="#"><img src="images/Icon_Facebook.png" alt="facebook"/></a>
                </div>
                <div class="login_with">SIGN IN WITH FACEBOOK</div>
            </div>

            <div class="Other_login">
                <div class="icon">
                    <a href="#"><img src="images/Icon_google.png" alt="google"/></a>
                </div>
                <div class="login_with">SIGN IN WITH GOOGLE</div>
            </div><!--End .Other_login-->

        </div><!--End #sign_in-->

        <div id="not_udacian">
            Not a Udacian yet? <span>Sign Up</span>
        </div><!--End #not_udacian-->
    </div><!--End #login-->

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