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
<script src="js/users.js"></script>
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
						<h3 class="panel-title">User's List</h3>
					</div>
					<div class="panel-body">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-10">
									<h3 class="panel-title"></h3>
								</div>
								<div class="col-md-2" align="right">
									<a href="add_users.php" class="btn btn-default btn-xs">Add New</a>
								</div>
							</div>
						</div>
						<table id="userList" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Type</th>
									<th>Status</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
 <!-- <?php include('inc/footer.php');?> -->
