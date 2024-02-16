<?php
	include '../checkElectionStatus.php';

	if($electionStatus != "open") : 
		include 'index-down-site.php';
	else : 
?>

<?php 
endif;
?>