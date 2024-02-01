<?php
	require 'conn.php';
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $action = $_POST['action'];

    if($action == 'save'){
        $memid = $_POST['mem_idx'];
        $cash = $_POST['cash'];
        $tshirt = $_POST['tshirt'];
        $eco = $_POST['eco'];
        $calen = $_POST['calen'];
        $abook = $_POST['abook'];
        $date = date('Y-m-d');

        $sqlUpdate = "INSERT INTO giveaways_record (voters_id, tshirt, ecobag, calendar, annual_book, cash, received_date, distributed_by) VALUES 
                        ('$memid', '$tshirt', '$eco', '$calen', '$abook', '$cash', '$date', '".$_SESSION['frontAccountID']."')";

        $votersUpdate = "update voters set giveaway_received = 'YES', date_received = '$date', give_away_cnt= '1', regs_face2face_cnt='1' where id = '". $memid ."'"; 

        if($conn->query($sqlUpdate) && $conn->query($votersUpdate)){
            $_SESSION['gaGiven'] = "Giveaways Saved.";
            echo 'success';
		}
		else{
			echo $conn->error;
		}
    }


    if($action == 'reloadCounter'){
        $tshirt = "SELECT count(tshirt) as tshirt from giveaways_record where distributed_by = '".$_SESSION['frontAccountID']."' and tshirt = 'true'";
        $ecobag = "SELECT count(ecobag) as ecobag from giveaways_record where distributed_by = '".$_SESSION['frontAccountID']."' and ecobag = 'true'";
        $calendar = "SELECT count(calendar) as calendar from giveaways_record where distributed_by = '".$_SESSION['frontAccountID']."' and calendar = 'true'";
        $annual_book = "SELECT count(annual_book) as annual_book from giveaways_record where distributed_by = '".$_SESSION['frontAccountID']."' and annual_book = 'true'";
        $pre_ga_voted = "select count(*) as pre_ga_voted from voters where isregistered = '1' and pre_ga_lane = '".$_SESSION['frontAccountID']."'";
                
        $query1 = $conn->query($tshirt);
        $query2 = $conn->query($ecobag);
        $query3 = $conn->query($calendar);
        $query4 = $conn->query($annual_book);
        $query5 = $conn->query($pre_ga_voted);
        echo json_encode([ 
            $query1->fetch_assoc(),
            $query2->fetch_assoc(),
            $query3->fetch_assoc(),
            $query4->fetch_assoc(),
            $query5->fetch_assoc(),
        ]);
    }