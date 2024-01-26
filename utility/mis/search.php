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
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> -->
<!-- <script src="js/categories.js"></script> -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css" > -->
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
						<h3 class="panel-title">UPDATE MEMBER'S STATUS</h3>
					</div>
					<div class="panel-body">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-10">
									<h3 class="panel-title"></h3>
								</div>
							</div>
						</div>
							<div class="col-md-12 well" style="background-color: #ffffff;">
								<!-- <h3 class="text-primary" id="demo"> </h3>
								<hr style="border-top:1px dotted #ccc;"/> -->
								<form method="POST" action="">
									<div class="form-inline pull-right">
										<input type="text" class="form-control" name="keyword" placeholder="PB# / MemID" required="required"/>
										<button class="btn btn-success" name="search"><span class="glyphicon glyphicon-search"></span> Search</button> &nbsp;&nbsp;&nbsp;<a href="search.php"><span class="glyphicon glyphicon-refresh" style="font-size:18px;"></span></a>
									</div>
								</form><br /><br />
								<?php include 'search_member.php'?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <?php include('inc/footer.php');?> -->
