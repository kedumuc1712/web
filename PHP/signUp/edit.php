<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>OWS</title>
    <meta name="author" content="Conglt"/>
    <meta name="keyword" content="OWS"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="makeup.css"/>
    <!-- CSS -->
    <style type="text/css">
        #login {
            padding-bottom: 5%;
        }
    </style>

    <!-- PHP -->
    <?php
    // Ket noi PHP voi MySQL
    $conn = mysqli_connect("localhost", "root", "", "ows");

    // Kiem tra ket noi
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Lay du lieu cu ra
    $id = $_GET["ID"];
    $query = mysqli_query($conn, "SELECT ID, firstName, lastName, email FROM user WHERE ID = '$id'");
    $row = mysqli_fetch_array($query);

    if (isset($_POST["save"])) {

        // Test input
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Du lieu moi
        $userId = $_POST["userId"];
        $newFirstName = test_input($_POST["firstname"]);
        $newLastName = test_input($_POST["lastname"]);
        $newEmail = test_input($_POST["email"]);

        if (empty($newFirstName) || empty($newLastName) || empty($newEmail)) {
            echo "chua dien thong tin";
        }

        $query = mysqli_query($conn, "SELECT ID, firstName, lastName, email FROM user");
        $row = mysqli_fetch_array($query);

        $sql = "UPDATE user SET firstName = '$newFirstName', lastName = '$newLastName',
                email = '$newEmail' WHERE ID = '$userId'";
        $result = mysqli_query($conn, $sql);

        header("Location: data.php");
    }
    mysqli_close($conn);

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
                    EDIT INFOMATION
                </div><!--End #sign_up-->
                <form action="edit.php" method="post">
                    <div id="name">
                        <input type="hidden" name="userId" value="<?php echo $_GET['ID']; ?>"/>
                        <div id="first_name">
                            <label for="fname"></label>
                            <input type="text" id="fname" name="firstname" value="<?php echo $row['firstName']; ?>"/>
                        </div><!--End #first_name-->

                        <div id="last_name">
                            <label for="lname"></label>
                            <input type="text" id="lname" name="lastname" value="<?php echo $row['lastName']; ?>">
                        </div>

                    </div><!--End #name-->

                    <div id="email">
                        <label for="email"></label>
                        <input type="email" id="mail" name="email" placeholder="Email"
                               value="<?php echo $row['email']; ?>">
                    </div><!--End #email-->

                    <div class="register">
                        <input type="submit" name="save" value="SAVE"/>
                    </div>
                </form> <!-- End form -->

            </div><!--End #window-->

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