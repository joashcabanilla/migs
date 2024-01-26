<?php 

    include 'includes/session.php';

	if(isset($_POST['save'])){

        $pref = $_POST["seqPrefix"];
        $seqNo = $_POST['seqNo'];
        $seqLength = $_POST['seqLength'];
        $seqFill = $_POST['seqFill'];
        $url = $_POST['url'];

        $sql = "UPDATE raffle_sequence SET prefix = '$pref', sequence_no = '$seqNo', no_fill = '$seqFill', sequence_length = '$seqLength'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Raffle sequence updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: ' . $url);
?>