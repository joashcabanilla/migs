<?php
session_start();
class Database{

	private $host  = 'localhost';
    private $user  = 'novadeci_mis';
    private $password   = "n0v@d3c11976missim";
    private $database  = "novadeci_votesystem";

    public function getConnection(){
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>
