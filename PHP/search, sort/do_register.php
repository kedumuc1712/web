<?php
	// Neu ajax duoc thuc thi
	if (isset($_POST["do_register"])) {
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

		$firstName = test_input($_POST["firstname"]);
		$lastName = test_input($_POST["lastname"]);
		$email = test_input($_POST["email"]);
		$password = $_POST["password"];
		$password = md5($password);

		$sql = "SELECT email FROM user WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			echo "fail";
		}
		else {
			$query = mysqli_query($conn, "INSERT INTO user (firstName, lastName, email, password)
				VALUES ('$firstName','$lastName', '$email', '$password')");
			echo "success";
			
		}
		mysqli_close($conn);
		exit();
	}
?>