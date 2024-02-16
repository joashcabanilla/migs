<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$voter = $_POST['voter'];
		$bday = date("m/d/Y", strtotime($_POST['bday']));
		$memberID = $_POST['memberID'];
		
		$sql = "SELECT * FROM voters WHERE id='$memberID' and bday='$bday' and status='MIGS'";
		
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect PB#/MemberID or Birth date';
		}
		else{
			$row = $query->fetch_assoc();
			if($bday = $row['bday']){
				$_SESSION['voter'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect PB#/MemberID or Birth date';
			}
		}

	}
	else{
		$_SESSION['error'] = 'Input voter credentials first';
	}

	header('location: index.php');

?>
