<?php
include_once 'config/Database.php';
include_once 'class/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if(!$user->loggedIn()) {
	header("location: index.php");
}
include('inc/header.php');
?>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
<link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
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
						
							<section class="content container-fluid">
									<div class="dashbord lagro-content" id="inner-div">
										<div class="title-section">
											<p><b>TOTAL RECORDS</b></p>
										</div>
										<div class="icon-text-section">
											<div class="icon-section">
												<i class="fa fa-spinner" aria-hidden="true"></i>
											</div>
											<div class="text-section">
												<a href="#">
													<?php
													    include('conn.php');
														foreach($conn->query('SELECT SUM(count)
														FROM voters') as $row) {
														echo "<h1 style='color:white;'>".number_format(46190)."</h1>";
														}
														
												// 		include('conn.php');
												// 		foreach($conn->query('SELECT SUM(count)
												// 		FROM voters') as $row) {
												// 		echo "<h1 style='color:white;'>".number_format($row['SUM(count)'])."</h1>";
												// 		}
                                                         
													?>
													</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="#">
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
												<a href="#">
													<?php
																foreach($conn->query('SELECT SUM(updated_count)
																FROM voters where status="MIGS"') as $row) {
																echo "<h1 style='color:white;'>".number_format($row['SUM(updated_count)'])."</h1>";
																}
															?>
													</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="#">
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
												<a href="#">
													<?php
																foreach($conn->query('SELECT SUM(modified_bday)
																FROM voters where modified_bday="1"') as $row) {
																echo "<h1 style='color:white;'>".number_format($row['SUM(modified_bday)'])."</h1>";
																}
															?>
													</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="#">
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
												<a href="#">
													<?php
																foreach($conn->query('SELECT SUM(count)
																FROM nonmigs where verification_stat="Pending"') as $row) {
																echo "<h1 style='color:white;'>".number_format($row['SUM(count)'])."</h1>";
																}
															?>
													</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="#">
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
												<a href="#">
													<?php
																foreach($conn->query('SELECT SUM(verified)
																FROM nonmigs where verification_stat="Verified"') as $row) {
																echo "<h1 style='color:white;'>".number_format($row['SUM(verified)'])."</h1>";
																}
															?>
													</a>
											</div>
											<div style="clear:both;"></div>
										</div>
										<div class="detail-section">
											<a href="#">
												<p>View Detail</p>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>
							</section>
						
					</div>
	</div>
	<?php include('inc/footer.php');?> 
</section>
