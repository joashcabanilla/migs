// <?php

// 	$parse = parse_ini_file('novadeci-election/admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
// 	$system_stat = $parse['system_status'];

// 	if($system_stat == "UP") {
//     header("location: index.php");
//   } 

// ?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<style>

body, html {
  height: 90%;
  margin: 0;
}

.bgimg {
  background-image: url('convention.jpg');
  height: 90%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: green;
  font-family: "Courier New", Courier, monospace;
  font-size: 18px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">

  </div>
  <div class="middle">
  <!--    <h1>This site is currently Offline! </h1>-->
		<!--<img src="img/1.png" width="300px;" style="margin-top: 7px;"/>-->
    <!--<h1>The 48th GA Registration and Voting System is<br />-->
    <h1>The MIGS Verifier System is<br />
    <h1 style="color:purple">TEMPORARILY CLOSED.</h1> 
    <!--<hr>-->
   
  </div>
  <div class="bottomleft">

  </div>
</div>

</body>
</html>
