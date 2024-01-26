<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$id = $_POST['id'];
		$isregistered = $_POST['isregistered'];

		$sql = "SELECT * FROM voters WHERE id = $id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE voters SET isregistered = '1' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	// else{
	// 	$_SESSION['error'] = 'Fill up edit form first';
	// }

	// header('location: voters.php');

?>
