<?php
session_start();
class Database{

	//for live website
	// private $host  = 'localhost';
    // private $user  = 'u209391291_mis_votes';
    // private $password   = "n0v@d3c11976MIS";
    // private $database  = "u209391291_votesystem";

	//for local dev site
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "migs";

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
