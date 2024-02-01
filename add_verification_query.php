<?php
require_once 'conn.php';
if(ISSET($_POST['save'])){
	$pbnum = $_POST['pbnum'];
	$memid = $_POST['memid'];
	$name = $_POST['name'];
	$bday = $_POST['bday'];
	$contact_no = $_POST['contact_no'];
	$branch = $_POST['branch'];
	$status = $_POST['status'];
	$verification_stat = $_POST['verification_stat'];

	$sql = "SELECT * FROM nonmigs WHERE contact_no='$contact_no' OR pbnum='$pbnum'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {

		echo ('<script>alert("Sorry... you already submitted a request for status verification. \n Please wait for your Account Officer to call you!")
            window.location="https://migs.novadeci.com/"</script>');
	}else{
	mysqli_query($conn, "INSERT INTO nonmigs SET pbnum='$pbnum', memid='$memid', name='$name', bday='$bday', contact_no='$contact_no', branch='$branch', status='$status', verification_stat='$verification_stat'") or die(mysqli_error());
	header("Refresh: 3; url= https://migs.novadeci.com/");
	echo '<div style="background-color:purple;color:white;text-align:center;margin-top:150px;"><h1>Request for Status Verification Sent successfully!</h1></div>';
	}
	}
?>
