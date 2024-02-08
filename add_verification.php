<?php
	require 'conn.php';
    $dateTime = new DateTime();
    $dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));

    $result = array();
    $pbno = $_POST['pbno'];
    $memid = $_POST['memid'];
    $name = $_POST['name'];
    $bday = $_POST['bday'];
    $branch = $_POST['branch'];
    $status = $_POST['status'];
    $verification_stat = $_POST['verification_stat'];
    $contact_no = $_POST['contact_no'];
    $date = $dateTime->format("Y-m-d H:i:s");

    $result["status"] = "success";
    $sql = $conn->query("SELECT * FROM `nonmigs` WHERE `pbnum`='$pbno' and `memid`='$memid' and `name`='$name' and `bday`='$bday'");

    if($sql->num_rows > 0){
        $result["status"] = "failed";
        $result["message"] = "Sorry, you have already submitted a request for status verification. Please wait for your Account Officer to call you.";
    }else{
        mysqli_query($conn, "INSERT INTO nonmigs SET pbnum='$pbno', memid='$memid', name='$name', bday='$bday', contact_no='$contact_no', branch='$branch', status='$status', verification_stat='$verification_stat', date='$date'");
        $result["message"] = "Request for MIGS status verification has been saved successfully.";
    }
    
    echo json_encode($result);
?>