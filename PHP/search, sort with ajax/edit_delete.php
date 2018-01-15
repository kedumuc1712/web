<?php
	$conn = mysqli_connect("localhost", "root","","ows");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if (isset($_POST["delete_row"])) {
		$id_delete = $_POST["row_id"];

		$delete = "DELETE FROM user WHERE ID = '$id_delete'";
		$result = mysqli_query($conn, $delete);
		echo "success";
		exit();
	}

	if (isset($_POST["edit_row"])) {

		function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

		$id_edit = $_POST["row_id"];
		$newFirstName = test_input($_POST["newFirstName"]);
		$newLastName = test_input($_POST["newLastName"]);
		$newEmail = test_input($_POST["newEmail"]);

		if (empty($newFirstName) || empty($newLastName) || empty($newEmail)) {
			echo "Infomation is not full";
			exit();
		}

		// Kiem tra dinh dang email
		if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
			echo "email type is incorrect";
      		exit();
    	}

		$query = mysqli_query($conn, "UPDATE user
		SET firstName = '$newFirstName', lastName = '$newLastName', email = '$newEmail'
		WHERE ID = '$id_edit'");

		echo "success";
		exit();
	}
	mysqli_close($conn);
?>