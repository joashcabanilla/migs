<?php
  error_reporting(1);

  const DB_HOST = 'localhost';
  const DB_USER = 'u209391291_mis_votes';
  const DB_PASS = 'n0v@d3c11976MIS';
  const DB_NAME = 'u209391291_votesystem';

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(!$connection) {
    die("Database connection failed.");
  }
?>
