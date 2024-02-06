<?php
include_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();
include('inc/header.php');
?>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="icon" href="novadeci-election/assests/icon/favicon.ico">
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
</head>
<body>
<br>
<section id="main">
	<div class="col-md-3"></div>
	<div class="col-md-6 well" style="background-color:green">
		<img src="img/1.png" width="270px;" style="margin-top: 7px;"/><h2 class="text-primary" style="color:#abdbe3; text-align:center">48th General Assembly<br /><i style="color:white;">MIGS VERIFICATION</i></h2>
			<h5 style="text-align:center; color:yellow;font-size:11px;">MEMBERSHIP CUT OFF DATE: <span class="label label-info" style="font-size:12px;">MARCH 2, 2024</span></h5>
		<hr/>
		<form method="POST" action="">
			<div class="form-inline pull-left">
				<h4 class="text-primary" style="color:white">MEMBER ID / PB#</h4>
				<input type="text" class="form-control form-inline pull-left" name="keyword" placeholder="Type here..." required="required" style="width:220px;font-size:25px;margin-right:5px;" autofocus/>
				<button class="btn btn-success" name="search"><span class="glyphicon glyphicon-search"></span> Verify</button>

			</div>
			<div class="form-inline pull-left">
				<h4 class="text-primary" style="color:yellow; margin-left:20px;"><i style="color:white;">Example format for</i> PB number "001234" no Dash(-), kapag may letra naman "N001234" <br /><i style="color:white;">at kung</i> Member ID "0010000000123456",<br /><i style="color:white;"> ang i lalagay lang ang</i> 123456</h4>
				<h5 style="color:white;margin-left:20px;"><b>Note:Priority ang Old Passbook sa pag verify</b></h5><br />
			</div>
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		</form>
		<?php include 'search_member.php'?>
	</div>
</section>

<!-- <?php include('inc/footer.php');?> -->
