<?php

	include_once 'conn.php';

	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	if($_SESSION['frontAccountID']){
		$sqlUpdate = "update users set status = 'offline' where user_id='". $_SESSION['frontAccountID']."'";
		$queryU = $conn->query($sqlUpdate);
	}

	session_destroy();

	// unset(
	// 	$_SESSION['frontAccountID'], 
	// 	$_SESSION['frontAccountName'], 
	// 	$_SESSION['frontAccountUsername'], 
	// 	$_SESSION['frontAccountStatus'], 
	// 	$_SESSION['frontAccountIsLogin']
	// );

	header('location: ../');
?>