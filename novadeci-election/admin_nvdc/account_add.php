<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$uFullname = $_POST['uFullname'];
		$uUsername = $_POST['uUsername'];
		$uPassword = $_POST['uPassword'];
		$uType = $_POST['uType'];

		$pass = password_hash($uPassword, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (name, username, password, status, account_status, account_type) VALUES 
				('$uFullname', '$uUsername', '$pass', 'offline', 'active', '$uType')";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Account added successfully!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: accounts.php');
?>
