<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['a_id'];
		$fullname = $_POST['efullname'];
		$usrname = $_POST['eusername'];
		$password = $_POST['epassword'];
		$account_status = $_POST['e_account_status'];
		$type = $_POST['eType'];


		$pass =  password_hash($password, PASSWORD_DEFAULT);

		$passColumn = $password == '' ? '' : ", password = '".$pass."'"; 

		$sql = "UPDATE users SET name = '$fullname', username = '$usrname', account_status = '$account_status', account_type = '$type' $passColumn WHERE user_id = '$id'";
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Account updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: accounts.php');

?>
