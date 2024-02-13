<?php
include_once 'config/Database.php';
include_once 'class/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if($user->loggedIn()) {
	header("location: dashboard.php");
}
$loginMessage = '';
if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];
	if($user->login()) {
		header("location: dashboard.php");
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
}
include('inc/header.php');
?>
<title>MigsUtility</title>
<!-- <link rel="icon" href="icon/favicon.ico"> -->
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<?php include('inc/container.php');?>
<div class="container contact">
	<div class="" style="margin:auto;width:350px;">
		<div >
		<div class="panel panel-success">
			<div class="panel-heading" style="background:green;color:white;text-align:center">
				<div class="panel-title">MIGS STATUS - UTILITY</div>
			</div>
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="email" name="email" placeholder="username" style="background:white;" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password"placeholder="password" required>
					</div>
					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls" style="text-align:center">
						  <input type="submit" name="login" value="Login" class="btn btn-success">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>
