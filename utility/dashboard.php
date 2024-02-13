<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include('conn.php');
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if(!$user->loggedIn()) {
	header("location: index.php");
}

$sql = "SELECT * FROM voters";
$memberData = $totalData = array();

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$memberData = $result->fetch_all(MYSQLI_ASSOC);
}

$totalData["status"] = $totalData["bday"] = $totalData["verified"] = $totalData["not-verified"] =array();

foreach($memberData as $data){
	$totalData["record"][] = $data;

	if(!empty($data["update_status"])){
		$totalData["status"][] = $data;
	}

	if(!empty($data["update_bday"])){
		$totalData["bday"][] = $data;
	}
}

$sql = "SELECT * FROM nonmigs";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$nonmigsData = $result->fetch_all(MYSQLI_ASSOC);
}

foreach($nonmigsData as $data){
	if($data["verification_stat"] == "Verified"){
		$totalData["verified"][] = $data;
	}else{
		$totalData["not-verified"][] = $data;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap-3.3.5.min.css">
		<link rel="icon" href="icon/favicon.ico">
		<script src="js/jquery-2.1.3.min.js"></script>
		<script src="js/bootstrap-3.3.5.min.js"></script>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>

		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
		<link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
		<title>MIGS UTILITY DASHBOARD</title>
	</head>
	<body>
		<?php include "menus.php"; ?>
		<br>
		
		<section id="main">
			<div class="container">
				<div class="row">
					<?php include "left_menus.php"; ?>
					<div class="col-md-9">
						<div class="panel panel-default">
							<div class="panel-heading" style="background:green;color:white;">
								<h3 class="panel-title">MIGS UTILITY</h3>
							</div>
							<div class="panel-body">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-10">
											<h3 class="panel-title"></h3>
										</div>
									</div>
								</div>

								<section class="container-fluid">
									<div class="dashbord lagro-content" id="inner-div">
										<div class="title-section">
											<p><b>TOTAL RECORDS</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a> 
													<?php echo "<h1 style='color:white;'>".number_format(count($totalData["record"]))."</h1>";?>
												</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="dashboard.php">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>

									<div class="dashbord tsora-content" id="inner-div">
										<div class="title-section">
											<p><b>&nbsp;&nbsp; UPDATED STATUS &nbsp;&nbsp;</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a> 
													<?php echo "<h1 style='color:white;'>".number_format(count($totalData["status"]))."</h1>";?>
												</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="search.php">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>

									<div class="dashbord cubao-content" id="inner-div">
										<div class="title-section">
											<p><b>&nbsp;&nbsp; UPDATED BIRTDATE &nbsp;&nbsp;</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a> 
													<?php echo "<h1 style='color:white;'>".number_format(count($totalData["bday"]))."</h1>";?>
												</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="search2.php">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>

									<div class="dashbord pending-content" id="inner-div">
										<div class="title-section">
											<p><b>&nbsp;&nbsp; FOR VERIFICATION &nbsp;&nbsp;</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a> 
													<?php echo "<h1 style='color:white;'>".number_format(count($totalData["not-verified"]))."</h1>";?>
												</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="verification.php">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>

									<div class="dashbord munoz-content" id="inner-div">
										<div class="title-section">
											<p><b>&nbsp; VERIFIED STAT &nbsp;</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a> 
													<?php echo "<h1 style='color:white;'>".number_format(count($totalData["verified"]))."</h1>";?>
												</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="verification.php">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</section>

		<script>
				$(document).ready((e) => {
					setInterval(() => {
						location.reload();
					}, 5000);
				});
		</script>
	</body>
</html>