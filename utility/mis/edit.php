<?php
	session_start();
	include_once('conn.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$verification_stat = $_POST['verification_stat'];

		$sql = "UPDATE nonmigs SET verification_stat = '$verification_stat' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Status updated successfully';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member updated successfully';
		// }
		///////////////

		else{
			$_SESSION['error'] = 'Something went wrong in updating member';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to edit first';
	}

	header('location: verification.php');

?>
