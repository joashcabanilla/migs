<?php
	require_once 'conn.php';
	if(ISSET($_POST['id']) && !empty($_POST['id'])){
		$dateTime = new DateTime();
		$dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
		$currentDate = $dateTime->format("Y-m-d H:i:s");
		$id = $_POST['id'];
		$status = $_POST['status'];
		$updated_count = $_POST['updated_count'];
		$firstname = $_POST["updatedBy"];
		
		mysqli_query($conn, "UPDATE `voters` SET `status` = '$status', `updated_count` = '$updated_count', `update_status_by`='$firstname', `update_status`='$currentDate' WHERE `id` = '$id'");
	}
	$result = [
		"status" => "success",
		"message" => "Member status updated successfully!"
	];

	echo json_encode($result);
?>
