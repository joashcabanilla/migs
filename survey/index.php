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
<script>
   $(document).ready(function() {

$("input:radio[name=options]").click(function() {
$('#maindiv').hide('slide', {direction: 'left'}, 100);
$.post( "surveyck.php", {"opt":$(this).val(),"qst_id":$("#qst_id").val()},function(return_data,status){

if(return_data.next=='T'){
$('#q1').html(return_data.data.q1);
$('label[for=opt1]').html(return_data.data.opt1);
$('label[for=opt2]').html(return_data.data.opt2);

$("#qst_id").val(return_data.data.qst_id);
}
else{$('#maindiv').html("Thanks for your views");}

},"json");
$("#f1")[0].reset();
 $('#maindiv').show('slide', {direction: 'right'}, 1000);

     });


   });
</script>

<?Php
require "config.php";
$count=$dbo->prepare("select * from poll_qst where qst_id=1");
if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
}
echo "
<div id='maindiv' class='maindiv'>
<form id='f1'>
<table>
<tr><td>
<h3 id='q1'>$row->qst</h3></td></tr>
<tr><td>
<input type=hidden id=qst_id value=$row->qst_id>
<tr><td>
      <input type='radio' name='options' id='opt1' value='option1' > <label for='opt1' class='lb'>$row->opt1</label>
</td></tr>
<tr><td>
      <input type='radio' name='options' id='opt2' value='option2' >  <label for='opt2' class='lb'>$row->opt2</label>
</td></tr>



</table>
</form>
</div>


";
?>
</body>
</html>
