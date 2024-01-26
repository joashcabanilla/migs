<nav class="navbar navbar-default" style="background:green;color:white;text-align:center">
  <div class="container">
	<div class="navbar-header" >
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#" style="padding:0px;border-color:green"><img src="img/banner.svg" style="width:185px;"/></a>
	</div>
	<div id="navbar" class="collapse navbar-collapse">
	  <!-- <ul class="nav navbar-nav">
		<li class="active"><a href="#">Dashboard</a></li>
	  </ul> -->
	  <?php if(!empty($_SESSION["userid"])) { ?>
	  <ul class="nav navbar-nav navbar-right">
		<li class="" style="background-color:purple;color:white"><a style="color:white"><?php echo $_SESSION["name"]; ?></a></li>
		<li><a href="logout.php" style="color:white">Logout</a></li>
	  </ul>
	  <?php } ?>
	</div>
  </div>
</nav>
