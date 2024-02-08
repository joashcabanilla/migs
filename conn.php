<?php
	//for live website
	// $host  = 'localhost';
    // $user  = 'u209391291_mis_votes';
    // $password   = "n0v@d3c11976MIS";
    // $database  = "u209391291_votesystem";

	//for local dev site
	$host  = 'localhost';
	$user  = 'root';
	$password   = "";
	$database  = "migs";

	$conn = mysqli_connect($host, $user, $password, $database);

	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>
