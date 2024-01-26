<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['em_id'];
		$firstname = $_POST['em_Fname'];
		$middlename = $_POST['em_Mname'];
		$lastname = $_POST['em_Lname'];
		$pbno = $_POST['em_pbno']; // value of pbnum
		$memid = $_POST['em_memID'];
		$bday = $_POST['em_bday'];
		$status = $_POST['em_status'];
		$voted_date = $_POST['vDate'];
		
		$insertToPBNO = $pbno == "-" ? $memid : $pbno;
		$toPBNUM = $pbno == "-" ? null : $pbno;

		$sql = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', middlename = '$middlename',
		bday = '$bday', status = '$status', memid = '$memid', pbnum = '$toPBNUM', voted_date = '$voted_date',
		pbno = '$insertToPBNO' WHERE id = '$id'";
		
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Member updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: voters.php');

?>
