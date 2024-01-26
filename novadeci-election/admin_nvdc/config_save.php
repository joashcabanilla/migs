<?php
	include 'includes/session.php';

	$return = 'home.php';
	if(isset($_GET['return'])){
		$return = $_GET['return'];
	}
	
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_POST['save'])){
		$title = $_POST['title'];
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];
		$f2fIP = explode(',',$_POST['f2f']);
		$system_stat = $_POST['system_stat'];

		$file = 'config.ini';
		$content = 'election_title = '.$title. '
					system_status = '.$system_stat.'
					election_start_time = '.$start_time .'
					election_end_time = '.$end_time.'
					f2f_ip = '.json_encode($f2fIP);

		file_put_contents($file, $content);

		if($system_stat == 'DOWN'){
			if($_SESSION['user_id']){
				$sqlUpdate = "update users set status = 'offline'";
				$queryU = $conn->query($sqlUpdate);
			}
			session_destroy();
		}

		$_SESSION['success'] = 'Configuration updated successfully';
		
	}
	else{
		$_SESSION['error'] = "Fill up config form first";
	}

	header('location: '.$return);

?>