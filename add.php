<?php
	require_once 'conn.php';

	if(ISSET($_POST['add'])){
		$pbno = $_POST['pbno'];
		$name = $_POST['name'];

		mysqli_query($conn, "INSERT INTO `members` VALUES('', '$pbno', '$name')") or die(mysqli_error());
		echo "<script>alert('New record saved!')</script>";
		echo "<script>window.location = 'index.php'</script>";
	}
?>
