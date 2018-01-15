<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>OWS</title>
    <meta name="author" content="Conglt"/>
    <meta name="keyword" content="OWS"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="makeup.css"/>

    <?php
    // Khi an vao nut Sign Up
    if (isset($_POST["do-register"])) {
        // Ket noi PHP voi MySQL
        $conn = mysqli_connect("localhost", "root", "", "ows");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Test input
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Khoi tao bien
        $firstName = test_input($_POST["firstname"]);
        $lastName = test_input($_POST["lastname"]);
        $email = test_input($_POST["email"]);
        $password = $_POST["password"];
        $password = md5($password);

        if ($firstName == NULL || $lastName == NULL || $email == NULL || $password == NULL) {
            echo "<script type='text/javascript'> alert('Infomation is not full');</script>";
            $page = $_SERVER['PHP_SELF'];
            $sec = "1";
            header("Refresh: $sec; url=$page");
            return 0;
        }

        //Kiem tra username hoac email co bi trung hay khong
        $sql = "SELECT * FROM user WHERE email = '$email'";

        // thuc thi cau truy van
        $result = mysqli_query($conn, $sql);

        // Neu ket qua lon hon 1 thi nghia la name hoac email da trung
        if (mysqli_num_rows($result) > 0) {
            echo "<script type='text/javascript'> alert('Information is exists');</script>";
            // Reload trang
            $page = $_SERVER['PHP_SELF'];
            $sec = "0.1";
            header("Refresh: $sec; url=$page");
            return 0;
        } else {
            $sql = "INSERT INTO user (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "<script type='text/javascript'> alert('Register is Success');</script>";
                // refresh lai trang

                header("location: data.php");
        
            } else {
                echo "<script type='text/javascript'> alert('Register is not Success');</script>";
                $page = $_SERVER['PHP_SELF'];
                $sec = "0.1";
                header("Refresh: $sec; url=$page");
                return 0;
            }
        }
        mysqli_close($conn);
    }
    ?>
</head>
<body>
<div id="global">

    <div id="header">

        <div id="cloud">
            <img width="150px" height="auto" src="image/cloud.png" alt="header"/>
        </div><!--End #touch_bar-->

    </div><!--End #header-->

    <div id="content">
        <div id="login">
            <div id="window">

                <div id="sign_up">
                    SIGN UP
                </div><!--End #sign_up-->
                <form action="register.php" method="post">
                    <div id="name">

                        <div id="first_name">
                            <label for="fname"></label>
                            <input type="text" id="fname" name="firstname" placeholder="First Name">
                        </div><!--End #first_name-->

                        <div id="last_name">
                            <label for="lname"></label>
                            <input type="text" id="lname" name="lastname" placeholder="Last Name">
                        </div>

                    </div><!--End #name-->

                    <div id="email">
                        <label for="email"></label>
                        <input type="email" id="mail" name="email" placeholder="Email">
                    </div><!--End #email-->

                    <div id="password">
                        <label for="password"></label>
                        <input type="password" id="pass" name="password" placeholder="Password">
                    </div><!--End #password-->

                    <div class="register">
                        <input type="submit" name="do-register" value="SIGN UP"/>
                    </div>
                </form>

                <div id="Or">
                    <div class="line1">
                        <hr/>
                    </div><!--End .line1-->

                    <div class="text_or">Or</div>

                    <div class="line2">
                        <hr/>
                    </div><!--End .line2-->
                </div><!--End #Or-->

                <div id="facebook">
                    <div class="face"><a href="#"><img width="8px" height="auto" src="image/face.png" alt="face"></a>
                    </div>
                    <div class="with_face">SIGN IN WITH FACEBOOK</div>
                </div><!--End #facebook-->

                <div id="google">
                    <div class="gmail"><a href="#"><img width="14px" height="auto" src="image/gmail.png"
                                                        alt="google"></a></div>
                    <div class="with_gmail">SIGN IN WITH GOOGLE</div>
                </div><!--End #google-->

            </div><!--End #window-->

            <div id="already">
                Already a Udacian? <span><a href="#">Sign in</a></span>
            </div><!--End #already-->

        </div><!--End #login-->

    </div><!--End content-->

    <div id="menu">
        <div id="table">
            <div class="feature">
                <h3 class="heading">FEATURE NANODEGREE</h3>
                <ul style="list-style-type: circle">
                    <li><a href="#">Full Stack Web Developer</a></li>
                    <li><a href="#">iOS Developer</a></li>
                    <li><a href="#">Machine Learning Engineer Nanodegree by Google</a></li>
                    <li><a href="#">Intro Programing</a></li>
                    <li><a href="#">Senior Web Development Nanodegree bt Google</a></li>
                    <li><a href="#">Beginning iOS app development</a></li>
                    <li><a href="#">Data Analyst</a></li>
                </ul>
            </div><!--End #table-->

            <div class="student">
                <h3 class="heading">STUDENT RESOURCES</h3>
                <ul style="list-style-type: circle">
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Help and FAQ</a></li>
                    <li><a href="#">Catalog</a></li>
                    <li><a href="#">Veteran Program</a></li>
                    <li><a href="#">Android App</a></li>
                    <li><a href="#">iOS app</a></li>
                </ul><!--End #student-->
            </div>

            <div class="udacity">
                <h3 class="heading">UDACITY</h3>
                <ul style="list-style-type: circle">
                    <li><a href="#">About</a></li>
                    <li><a href="#">In The News</a></li>
                    <li><a href="#">Jobs @ Udacity</a></li>
                    <li><a href="#">Georgia Tech</a></li>
                    <li><a href="#">Udacity for Business</a></li>
                    <li><a href="#">Hire Graduates</a></li>
                    <li><a href="#">Student Success</a></li>
                </ul><!--End #udacity-->
            </div>

            <div id="logo">
                <img width="120px" height="auto" src="image/Logo2.png" alt="cloud_meeting"/>
            </div><!--End #logo-->

        </div><!--End #table-->

    </div><!--End #menu-->

    <div id="footer">

        <div id="copy_right">
            <span>NONADEGREE IS A TRADEMARK OF UDACITY &copy; 2011 - 2017 UDACITY, INC.</span>
        </div>

        <div id="image">
            <img src="image/visa.png" alt="visa"/>
            <img src="image/master_card1.png" alt="mc1"/>
            <img src="image/master_card2.png" alt="mc2"/>
            <img src="image/paypal.png" alt="paypal"/>
            <img src="image/western_union.png" alt="western_union"/>
            <img src="image/money.png" alt="money.png"/>
        </div><!--End #image-->

    </div><!--End #footer-->
</div> <!--End #global-->
</body>
</html>