<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>MIGSutility</title>
	<link rel="stylesheet" href="google-material/material-icons.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">

<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<body>
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">

					<i class="material-icons check_circle">&#xE876;</i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.location.href='index.php'">&times;</button>
			</div>
			<div class="modal-body text-center">
				<label>Member status updated successfully!</label>
				<br />
				<button class="btn btn-success" data-dismiss="modal" onclick="window.location.href='index.php'"><span>Close</span></button>
			</div>
		</div>
	</div>
</div>
</body>
</html>
