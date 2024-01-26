<?php
	session_start();

	unset($_SESSION['migs_pbno'], $_SESSION['voter']); // unset only for voters logout

	header('location: ../');
?>