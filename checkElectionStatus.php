<?php
	$dateTime = new DateTime();
    $dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));

    $parse = parse_ini_file('novadeci-election/admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
    $title = $parse['election_title'];
    $start_time = $parse['election_start_time'];
    $end_time = $parse['election_end_time'];
    $start_date = $parse['election_start_date'];
    $end_date = $parse['election_end_date'];

    $currentDay = $dateTime->format("Y-m-d");
    $electionDayStatus = date("Y-m-d", strtotime($start_date)) <= $dateTime->format("Y-m-d") && date("Y-m-d", strtotime($end_date)) >= $dateTime->format("Y-m-d");
    
    $electionStartTime = new DateTime(date("Y-m-d h:i A", strtotime($currentDay." ".$start_time)));

    $electionEndTime = new DateTime(date("Y-m-d h:i A", strtotime($currentDay." ".$end_time)));

    $currentDateTime = new DateTime($dateTime->format("Y-m-d h:i A"));

    $electionTimeStatus =  $electionStartTime <= $currentDateTime && $electionEndTime >= $currentDateTime;

    $electionStatus = $electionDayStatus && $electionTimeStatus ? "open" : "closed";
?>