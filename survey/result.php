<?Php
session_start();
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<script src="assets/jquery-3.5.1.min.js"></script>
<script src="assets/jquery-ui.min.js"></script>

<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?Php
require "config.php";
for($i=1;$i<=1;$i++){ // loop for 10 questions
$query="select opt, count(ans_id) as no, opt1,opt2,qst  from poll_answer left join poll_qst on poll_qst.qst_id=poll_answer.qst_id where poll_answer.qst_id=$i group by opt";
foreach ($dbo->query($query) as $row) {
switch ($row['opt']){
case 'option1':
$opt1=$row['opt1'];
$no1=$row['no'];
break;

case 'option2':
$opt2=$row['opt2'];
$no2=$row['no'];
break;

}
//echo "<br>$row[ans],$row[no] <br>";
}
$total=($no1+$no2);
$no1_p=number_format($no1*100/$total);
$no2_p=number_format($no2*100/$total);



//////////////
echo "<b>$row[qst]</b> <br><br>";
echo "$opt1 ($no1) $no1_p%";
echo "<br><br>$opt2 ($no2) $no2_p% ";

echo "<br><br>Total answers : $total <hr>";

} //end of for loop for ten questions
?>
</body>
</html>
