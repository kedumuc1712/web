<?php
	session_start();
	if (isset($_POST["do_login"])) {
		$conn = mysqli_connect("localhost", "root","", "ows");

		$email = $_POST["email"];
		$pass = $_POST["password"];
		$pass = md5($pass);

		$sql = "SELECT email, password FROM user WHERE email = '$email' AND password = '$pass'";
		$result = mysqli_query($conn,$sql);

		if ($row = mysqli_fetch_array($result)) {
			$_SESSION["email"] = $row["email"];
			echo "success";
		}
		else {
			echo "fail";
		}
		exit();
	}
?>