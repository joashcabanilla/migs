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
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
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
						<h3 class="panel-title">FOR VERIFICATION LIST</h3>
					</div>
					<div class="panel-body">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-12">
									<h3 class="panel-title"></h3>
								</div>
							</div>
						</div>
							<div class="container">
								<div class="row">
									<div class="col-sm-8">
										<div class="row">
										<?php
											if(isset($_SESSION['error'])){
												echo
												"
												<div class='alert alert-danger text-center'>
													<button class='close'>&times;</button>
													".$_SESSION['error']."
												</div>
												";
												unset($_SESSION['error']);
											}
											if(isset($_SESSION['success'])){
												echo
												"
												<div class='alert alert-success text-center'>
													<button class='close'>&times;</button>
													".$_SESSION['success']."
												</div>
												";
												unset($_SESSION['success']);
											}
										?>
										</div>
										<!-- <div class="row">
											<a href="print_pdf.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
										</div> -->
										<div class="height10"></div>

										<div class="row">
											<table id="myTable" class="table table-bordered table-striped">
												<thead>
													<th>PB#</th>
													<th>MemID</th>
													<th width="25%">Name</th>
													<th>BirthDate</th>
													<th>Contact#</th>
													<th>Branch</th>
													<th>Status</th>
													<th width="20%">Date</th>
													<th></th>
												</thead>
												<tbody>
													<?php
														include_once('conn.php');
														$sql = "SELECT * FROM nonmigs";
														$query = $conn->query($sql);
														while($row = $query->fetch_assoc()){
														    $status=$row['verification_stat'];
																if($status=="Verified")
																{
																    $color="color:green";
																}
																else if($status=="Pending")
																{
																    $color="color:red";
																}
																else
																{
																    $color="color:orange";
																}
															echo
															"<tr>
																<td>".$row['pbnum']."</td>
																<td>".$row['memid']."</td>
																<td>".$row['name']."</td>
																<td>".$row['bday']."</td>
																<td>".$row['contact_no']."</td>
																<td>".$row['branch']."</td>
																<td style='$color'>".$row['verification_stat']."</td>
																<td>".$row['date']."</td>
																<td>
																	<a href='#edit_".$row['id']."' class='btn btn-warning btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span></a>

																</td>
															</tr>";
															include('edit_delete_modal.php');
														}
													?>
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
							</div>

							<script src="jquery/jquery.min.js"></script>
							<script src="bootstrap/js/bootstrap.min.js"></script>
							<script src="datatable/jquery.dataTables.min.js"></script>
							<script src="datatable/dataTable.bootstrap.min.js"></script>
							<!-- generate datatable on our table -->
							<script>
							$(document).ready(function(){

							    $('#myTable').DataTable();

							    //hide alert
							    $(document).on('click', '.close', function(){
							    	$('.alert').hide();
							    })
							});
							</script>
				</div>
			</div>
		</div>
	</div>
</section>

 <?php include('inc/footer.php');?> 
