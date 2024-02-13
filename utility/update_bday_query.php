<?php
	require_once 'conn.php';
	if(ISSET($_POST['id']) && !empty($_POST['id'])){
		$dateTime = new DateTime();
		$dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
		$currentDate = $dateTime->format("Y-m-d H:i:s");
		$id = $_POST['id'];
		$bday = date("m/d/Y",strtotime($_POST['bday']));
		$firstname = $_POST['updatedBy'];

		mysqli_query($conn, "UPDATE `voters` SET `bday` = '$bday', `modified_bday` = '1', `update_bday_by` = '$firstname', `update_bday`='$currentDate' WHERE `id` = '$id'");

		$result = [
			"status" => "success",
			"message" => "Member birth date updated successfully!"
		];
	
		echo json_encode($result);
	}
?>
