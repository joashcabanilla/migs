<?php
	require_once 'conn.php';
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$status = $_POST['status'];
		$updated_count = $_POST['updated_count'];
		mysqli_query($conn, "UPDATE `voters` SET `status` = '$status', `updated_count` = '$updated_count' WHERE `id` = '$id'") or die(mysqli_error());
		// echo "<label><center>Member status updated!</center></label>";

header("Refresh: 1; url= search.php");
echo '<div style="background-color:purple;color:white;text-align:center;margin-top:150px;"><h1>Member status updated successfully!</h1></div>';

	}
?>
