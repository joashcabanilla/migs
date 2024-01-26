<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$pbno = $_POST['pbno'];
		$memID = $_POST['memID'];
		$nFName = $_POST['newFname'];
		$nMName = $_POST['newMname'];
		$nLName = $_POST['newLname'];
		$bday = $_POST['bday'];
		$membershipdate = $_POST['membershipdate'];
		$status = $_POST['status'];
		$branch = $_POST['branch'];

		$insertToPBNO = $pbno == "-" ? $memID : $pbno;
		$toPBNUM = $pbno == "-" ? null : $pbno;

		$sql = "INSERT INTO voters (pbno, firstname, middlename, lastname, bday, isregistered, membershipdate, status, branch, pbnum, memid, voted_date) VALUES 
				('$insertToPBNO', '$nFName', '$nMName', '$nLName', '$bday', '0', '$membershipdate', '$status', '$branch', '$toPBNUM', '$memID', '0000-00-00 00:00:00')";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Member added successfully!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>
