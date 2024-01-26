<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width-device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<table class="table table-striped">
		<thead class="alert-success">
			<tr>
				<th>ID</th>
				<th>PB#/MemID</th>
				<th>Name</th>
				<th>BirthDate</th>
				<th>Contact#</th>
				<th>Branch</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$keyword = $_POST['keyword'];
				$query = mysqli_query($conn, "SELECT * FROM `voters` WHERE pbno='$keyword' LIMIT 1") or die(mysqli_error());
				// $query = mysqli_query($conn, "SELECT * FROM `voters` WHERE `voters_id` LIKE '%$keyword%' LIMIT 1") or die(mysqli_error());
				$count = mysqli_num_rows($query);
				if($count > 0){
					while($fetch = mysqli_fetch_array($query)){
			?>
					<tr>
						<td><?php echo $fetch['id']?></td>
						<td><?php echo $fetch['pbno']?></td>
						<!--<td><?php echo $fetch['voters_id']?></td>-->
						<td><?php echo $fetch['firstname']." ". $fetch['middlename']." ". $fetch['lastname']?></td>
						<td><?php echo $fetch['bday']?></td>
						<td><?php echo $fetch['contact_no']?></td>
						<td><?php echo $fetch['branch']?></td>
						<td ><span class="label label-info"><?php echo $fetch['status']?> </span>
						<td>
							<button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $fetch['id']?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
						</td>
					</tr>
					<?php	include 'update_status.php'; ?>
			<?php
					}
				}else{
					echo "<tr><td colspan='4' class='text-danger'><center>No record found!</center></td></tr>";
				}
			?>
		</tbody>
	</table>
<?php
	}else{
?>
	<!-- <table class="table table-striped">
		<thead class="alert-success">
			<tr>
				<td>ID</td>
				<td>PB#/MemID</td>
				<td>Name</td>
				<td>Contact#</td>
				<td>Branch</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
		</thead>
	</table> -->
<?php
	}
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
