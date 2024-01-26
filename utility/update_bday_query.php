<?php
	require_once 'conn.php';
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$bday = trim($_POST['bday']);
		mysqli_query($conn, "UPDATE `voters` SET `bday` = '$bday', `modified_bday` = '1' WHERE `id` = '$id'") or die(mysqli_error());

header("Refresh: 1; url= search2.php");
echo '<div style="background-color:purple;color:white;text-align:center;margin-top:150px;"><h1>Member birth date updated successfully!</h1></div>';

	}
?>
