<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	include 'includes/update_isregistered.php';
    error_reporting(0);
	if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

	if(isset($_POST['vote'])){
		echo $_POST['vote'];
		$hasAccount = $_SESSION['frontAccountID'] != null ? " pre_ga_lane = '".$_SESSION['frontAccountID']."', " : '';

		$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

		$isF2F = isFace2Face($host);
		
		$ticketRaw = get_raffle_ticket_sequence($conn);
		$ticket = $isF2F ? '' :
				$ticketRaw['prefix'] . str_pad($ticketRaw['sequence_no'],  $ticketRaw['sequence_length'], $ticketRaw['no_fill'], STR_PAD_LEFT );

		if(count($_POST) == 1){
			$candidate = $_POST[$position];
			$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$candidate', '$pos_id')";
			$r_date = date('Y-m-d H:i:s');

			$sql2 = "UPDATE voters SET ".$hasAccount." isregistered = '1', comp_name = '$host', regs_date='$r_date', ticket = '$ticket' WHERE id = '".$voter['id']."'";
			$query2 = $conn->query($sql2);

			if(!$error){
				foreach($sql_array as $sql_row){
					$conn->query($sql_row);
				}
				unset($_SESSION['post']);
				$_SESSION['success'] = 'Ballot Submitted';
				$_SESSION['tix'] = $ticket;
				$isF2F ? null : addSequence($ticketRaw['sequence_no'], $conn);
			}
		}
		else{

			$_SESSION['post'] = $_POST;
			$sql = "SELECT * FROM positions";
			$query = $conn->query($sql);
			$error = false;
			$sql_array = array();
			while($row = $query->fetch_assoc()){
				$position = slugify($row['description']);
				$pos_id = $row['id'];
				if(isset($_POST[$position])){
					if($row['max_vote'] > 1){
						if(count($_POST[$position]) > $row['max_vote']){
							$error = true;
							$_SESSION['error'][] = 'You can only choose '.$row['max_vote'].' candidates for '.$row['description'];
						}
						else{
							foreach($_POST[$position] as $key => $values){
								$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$values', '$pos_id')";
								$r_date = date('Y-m-d H:i:s');

			                    $sql2 = "UPDATE voters SET ".$hasAccount." isregistered = '1', comp_name = '$host', regs_date='$r_date', ticket = '$ticket' WHERE id = '".$voter['id']."'";
								$query2 = $conn->query($sql2);
							}
						}
					}
					else{
						$candidate = $_POST[$position];
						$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$candidate', '$pos_id')";
						$r_date = date('Y-m-d H:i:s');

			            $sql2 = "UPDATE voters SET ".$hasAccount." isregistered = '1', comp_name = '$host', regs_date='$r_date', ticket = '$ticket' WHERE id = '".$voter['id']."'";
						$query2 = $conn->query($sql2);

					}
				}
			}

			if(!$error){
				foreach($sql_array as $sql_row){
					$conn->query($sql_row);
				}

				unset($_SESSION['post']);
				$_SESSION['success'] = 'Ballot Submitted';
				$_SESSION['tix'] = $ticket;
				$isF2F ? null : addSequence($ticketRaw['sequence_no'], $conn);
			}
		}
	}
	else{
		$_SESSION['error'][] = 'Select candidates to vote first';
	}

	header('location: home.php');

	function get_raffle_ticket_sequence($conn){

		$sql = "SELECT * from raffle_sequence";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

		if(empty($row)){
            $sql = "INSERT INTO raffle_sequence (prefix, sequence_no, no_fill, sequence_length) VALUES ('ON-', '1', '0', '5')";
            $conn->query($sql);

			return get_raffle_ticket_sequence($conn);

        } else {

			$ticket = $row['prefix'] . str_pad($row['sequence_no'],  $row['sequence_length'], $row['no_fill'], STR_PAD_LEFT );

			$sqlTicket = "SELECT ticket from voters where ticket = '$ticket'";
			$queryTicket = $conn->query($sqlTicket);
			$rowTicket = $queryTicket->fetch_assoc();
			
			if($rowTicket){
				addSequence($row['sequence_no'], $conn); 
				return get_raffle_ticket_sequence($conn);
			} else return $row;
		}
	}

	function addSequence($sequenceNo, $conn){
		$newTix = $sequenceNo + 1;
		$sql = "UPDATE raffle_sequence SET sequence_no = '$newTix'";
		$conn->query($sql);

		return $newTix;
	}

	function isFace2Face( $ip ){
		$parse = parse_ini_file('admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
		$ips = json_decode($parse['f2f_ip']);

		// remove white space in array
		$trimmed_ips = array_map('trim', $ips);

		return in_array($ip, $trimmed_ips);
	}

?>