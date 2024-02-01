<?php

	$parse = parse_ini_file('admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
	$system_stat = $parse['system_status'];

	if($system_stat == "DOWN") : 
		include 'index-down-site.php';
	?>

	<?php else : 
		error_reporting(0);
		session_start();
		if(isset($_SESSION['admin'])){
		  header('location: admin_nvdc/home.php');
		}
  
		if(isset($_SESSION['voter'])){
			header('location: home.php');
		}
		// if(!$_SESSION['migs_pbno']){
		// 	header('location: ../');
		// }
		
		include 'includes/header.php';
	?>


<!-- <style>
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-calendar-picker-indicator {
  display: none;
  -webkit-appearance: none;
}
</style> -->
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<img src="assests/img/banner.svg" />
  	</div>

  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" id="pbNo" name="voter" placeholder="PB# / Member's ID" readonly value="">
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback"><label>Format: MM/DD/YYYY (ex.03/29/2021)</label>
            <input type="date" class="date-input form-control" name="bday" placeholder="Birth Date" required>
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
          </div>
      		<div class="text-center">
            <button style="text-align:center;" type="submit" class="btn btn-success" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
      		</div><br />
          
          <label>Note: <br /><i> Incase of login error, please call </i> <span class="button btn-info" style="size:20px;text-align:center"> &nbsp;0917-620-3141&nbsp;</span></label>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error']) && $_SESSION['error']){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p>
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>

<?php include 'includes/scripts.php' ?>
<script>
	$(document).ready(() => {
		let pbno = localStorage.getItem("pbno");
		$("#pbNo").val(pbno);
	});
</script>
</body>
</html>

<?php endif; ?>