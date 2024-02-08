<?php
	require 'conn.php';
	include 'checkElectionStatus.php';
	
	$result = $memberData = array();
	$result["electionStatus"] = $electionStatus; 
	$search = strtoupper($_POST["search"]);
	$sql = $conn->query("SELECT * FROM `voters` WHERE `pbno`='$search' OR `memid`='$search'");
	$sqlResult = $sql->fetch_all(MYSQLI_ASSOC);

	foreach($sqlResult as $data){
		$memberData[]= [
			"id" => $data["id"],
			"memid" => !empty($data["memid"]) ? $data["memid"] : "No Data",
			"pbno" => !empty($data["pbno"]) ? $data["pbno"] : "No Data",
			"name" => utf8_encode($data["firstname"]." ".$data["middlename"]." ".$data["lastname"]),
			"status" => $data["status"],
			"registered" => $data["isregistered"] == 0 ? false : true,
			"bday" => $data["bday"],
			"branch" => $data["branch"],
			"status" => $data["status"]
		];
	}
	$result["memberData"] = $memberData;
	echo json_encode($result);
?>