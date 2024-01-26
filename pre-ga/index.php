<?php
  $parse = parse_ini_file('../novadeci-election/admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
  $system_stat = $parse['system_status'];

  if($system_stat == "DOWN") : 
    include 'index-down.php';
  ?>

  <?php 
  else : 
    include_once 'function/conn.php';
    include('inc/header.php');
    
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
        
    if(isset($_SESSION['frontAccountIsLogin']) == "loggedIn"){
      header('location: ../');
    }
  ?>

<?php include 'inc/header.php'; ?>

<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
	  <img src="assets/images/banner.svg" />
  	</div>

  	<div class="login-box-body">
    	<p class="login-box-msg">Pre GA - Login</p>

    	<form action="function/login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="Username" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-success btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
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

<?php include 'scripts.php' ?>
</body>
</html>
<?php 
endif; ?>