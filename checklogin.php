<?php
	session_start();

	$con = mysqli_connect("localhost", "root", "", "OVtRTA");
	if(mysqli_connect_errno()){ 
		echo "Failed to Connect You to MYSQL:" . mysqli_connect_error();
	}

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$query = mysqli_query($con, "SELECT * from users WHERE username='$username'");

	$exists = mysqli_num_rows($query);
	$table_users = "";
	$table_password = "";

	if ($exists > 0){
		while ($row = mysqli_fetch_assoc($query)){
			$table_users = $row['username'];
			$table_password = $row['password'];
		}

		if(($username == $table_users) && ($password == $table_password)) {
			$_SESSION['user'] = $username;
			header("location: home.php");
		}
		else {

			Print '<script>alert("FALSE Password!");</script>';
		}
	} else {
		Print '<script>alert("FALSE Username!");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}
?>