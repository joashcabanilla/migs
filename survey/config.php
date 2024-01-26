<?Php
///////// Database Details change here  ////
$dbhost_name = "localhost";
$database = "u209391291_votesystem";
$username = "u209391291_mis_votes";
$password = "n0v@d3c11976MIS";
//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage();
die();
}
?>
