<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="css/bootstrap-3.3.5.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="icon" href="novadeci-election/assests/icon/favicon.ico">
		<script src="js/jquery-2.1.3.min.js"></script>
		<script src="js/bootstrap-3.3.5.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title>NOVADECI MIGS Verifier</title>

		<style>
			hr.new2 {
			border-top: 1px dashed red;
			}
			.btn-work {
				font-size:12px;
				background-color:brown;
				width: 37px;
				height: 17px;
				margin: 0 auto;
				padding: 0;
				display: table-cell;
				vertical-align: middle;
			}
			.btn-work2 {
				font-size:12px;
				background-color:purple;
				width: 37px;
				height: 17px;
				margin: 0 auto;
				padding: 0;
				display: table-cell;
				vertical-align: middle;
			}
			#main{
				display: flex;
				justify-content: center;
				margin-top: 2rem;
			}

			table thead td{
				font-size:25px;
				text-align:center;
				font-weight: bold;
			}
			table thead td a{
				color:purple;
				cursor:pointer;
				text-decoration: none;
			}

			table thead td a:hover{
				text-decoration: none;
				color:purple;
				cursor:pointer;
			}

			table thead td .nonmigsLabel{ 
				font-size:20px;
				color:purple;
				cursor:pointer;
			}

			table thead td .nonmigsBtn{ 
				font-size:20px;
				color:blue;
				cursor:pointer;
			}
			.labelBlack{
				color: black;
			}
			.labelGreen{
				color: green;
			}
			.labelRed{
				color: red;
			}

			.labelGray{
				color: gray;
			}
			.memidLabel{
				margin-left: 1rem;
			}

			.button {
				border: none;
				color: white;
				padding: 3px 7px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 12px;
				margin: 3px 2px;
				cursor: pointer;
			}
		</style>
	</head>
	
	<body>
		<section id="main">
			<div class="col-md-6 well" style="background-color:#004b00;">
				<img src="img/1.png" width="270px;" style="margin-top: 7px;"/>
				<h2 class="text-primary" style="color:#abdbe3; text-align:center">48th General Assembly
					<br />
					<i style="color:white;">MIGS VERIFICATION</i>
				</h2>
				<h5 style="text-align:center; color:yellow;font-size:11px;font-weight:bold;">MEMBERSHIP CUT OFF DATE: 
					<span class="label label-info" style="font-size:12px;">MARCH 2, 2024</span>
				</h5>
				<hr/>
				
				<form method="POST" id="searchMemberForm">
					<div class="form-inline pull-left">
						<h4 class="text-primary" style="color:white">MEMBER ID / PB#</h4>
						<input type="text" class="form-control form-inline pull-left" name="search" placeholder="Type here..." required="required" style="width:220px;font-size:25px;margin-right:5px;" autofocus/>
						<button class="btn btn-success">
							<span class="glyphicon glyphicon-search"></span> Verify 
						</button>
					</div>
					<div class="form-inline pull-left">
						<h4 class="text-primary" style="color:yellow; margin-left:20px;"><i style="color:white;">Example format for</i> PB number "001234" no Dash(-), kapag may letra naman "N001234" <br /><i style="color:white;">at kung</i> Member ID "0010000000123456",<br /><i style="color:white;"> ang i lalagay lang ang</i> 123456</h4>
						<h5 style="color:white;margin-left:20px;"><b>Note:Priority ang Old Passbook sa pag verify</b></h5><br />
					</div>
				</form>

				<table class="table table-striped hide memberDataTable">
					<thead class="alert alert-warning">
						<tr class="alert alert-info">
							<td class="memberName"></td>
						</tr>
						<tr class="alert alert-success">
							<td>
								<label class="pbLabel labelBlack">PB#: </label>
								<label class="pbData"></label>
								<label class="memidLabel labelBlack">Member ID:</label>
								<label class="memidData"></label>
								<br />
								<label class="statusData"></label>
								<br />
								<a class='voteBtn'>>>> Click here to VOTE <<<</a>
								<label class="nonmigsLabel">Makipag ugnayan sa inyong account officer(AO)</label>
								<label class='nonmigsBtn' data-toggle='modal' data-target='#update_modal'>>> Please click here <<</label>
							</td>
						</tr>
					</thead>
				</table>

				<table class="table table-striped hide noRecordTable">
					<thead class="alert alert-warning">
						<tr>
							<td colspan='2' class='text-danger' style='font-size:24px;'>
								<center>
									<b>NO RECORD FOUND!</b>
									<br />
									<label style='font-size:16px;color:purple'>
										<u>Please Call these Hotline:</u>
										<br />
										<span class='' style='size:16px;text-align:center;color:brown'>
<pre>
0933-8673-769 / 0917-8766-796 (Tsora Office) &nbsp;&nbsp;
0917-6219-412 / (2)7115041 (Bulacan Office) &nbsp;&nbsp;
0917-6233-640 / 0917-8766-794 (Fairview Office)&nbsp;&nbsp;
0917-8350-689 / 0933-8673-779 (Kiko Office)    &nbsp;&nbsp;
0917-8766-782 / 896-204-26 (Camarin Office) &nbsp;&nbsp;
0917-8766-797 / 0933-8673-768 (Cubao Office)    &nbsp;&nbsp;
0917-6312-915 / 0933-8673-777 (BSilang Office) &nbsp;&nbsp;
0917-8766-802 (Lagro Office)   &nbsp;&nbsp;
0917-620-3141 (Main Office)    &nbsp;&nbsp;
0917-620-2749 (Main Office)    &nbsp;&nbsp;
0917-620-2618 (Main Office)    &nbsp;&nbsp;
0917-876-6795 (Main Office)    &nbsp;&nbsp;
</pre>
										</span>
									</label>
								</center>
							</td>
						</tr>
					</thead>
				</table>

				<div class="memberContainer"></div>
			</div>
		</section>

		<div class="modal fade" id="update_modal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="POST" id="nonmigsForm">
						<div class="modal-header"><button type="button" class="close" style="color: red;" data-dismiss="modal"><b>&times;</b></button>
							<h4 class="modal-title" style="color:black;text-align:center">REQUEST FOR MIGS STATUS VERIFICATION</h4><hr />
							<h3 class="modal-title nonmigsNameLabel" style="color:green;text-align:center"></h3>
						</div>
						<div class="modal-body">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="hidden" name="id"/>
									<input type="hidden" name="pbno"/>
									<input type="hidden" name="memid"/>
									<input type="hidden" name="name"/>
									<input type="hidden" name="bday"/>
									<input type="hidden" name="branch"/>
									<input type="hidden" name="status"/>
									<input type="hidden" name="verification_stat" value="Pending"/>
									<br />
									<label style="text-align:left;">Please type in your mobile number (ex.0966587XXXX)</label>
									<input type="tel" name="contact_no" id="contact_no" class="form-control" minlength="11" maxlength="11" onkeypress="return isNumeric(event)" style="text-align:center;font-size:24px;font-weight:bold;" required/>
								</div>
							</div>
							<div style="clear:both;">
							<div class="modal-footer"></div>
								<div style="text-align:center">
									<button name="save" class="btn btn-success"><span class="glyphicon glyphicon-cloud"></span> Submit</button>
								</div><br />
								<div style="text-align:center">
									<label>OR</label><br /><br />
									<label>You may Call these Hotlines:<br /> <span class="button btn-info" style="size:20px;text-align:center">
<pre>
0933-8673-769 / 0917-8766-796 (Tsora Office) &nbsp;&nbsp;
0917-6219-412 / (2)7115041 (Bulacan Office) &nbsp;&nbsp;
0917-6233-640 / 0917-8766-794 (Fairview Office)&nbsp;&nbsp;
0917-8350-689 / 0933-8673-779 (Kiko Office)    &nbsp;&nbsp;
0917-8766-782 / 896-204-26 (Camarin Office) &nbsp;&nbsp;
0917-8766-797 / 0933-8673-768 (Cubao Office)    &nbsp;&nbsp;
0917-6312-915 / 0933-8673-777 (BSilang Office) &nbsp;&nbsp;
0917-8766-802 (Lagro Office)   &nbsp;&nbsp;
0917-620-3141 (Main Office)    &nbsp;&nbsp;
0917-620-2749 (Main Office)    &nbsp;&nbsp;
0917-620-2618 (Main Office)    &nbsp;&nbsp;
0917-876-6795 (Main Office)    &nbsp;&nbsp;
</pre>
										</span></label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			  function maxLengthCheck(object) {
				if (object.value.length > object.maxLength)
				object.value = object.value.slice(0, object.maxLength)
			}

			function isNumeric (evt) {
				var theEvent = evt || window.event;
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode (key);
				var regex = /[0-9]|\./;
				if ( !regex.test(key) ) {
				theEvent.returnValue = false;
				if(theEvent.preventDefault) theEvent.preventDefault();
				}
			}

			$("#searchMemberForm").submit((e) => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'search_member.php',
					data: $(e.currentTarget).serializeArray(),
					dataType: 'json',
					success: function(res){
						$(".memberContainer").empty();
						$(".noRecordTable").addClass("hide");
						$("#nonmigsForm").find("input[name='contact_no']").val("");
						if(res.memberData.length > 0){
							res.memberData.forEach((data) => {
								let memberStatus = data.status == "MIGS" ? "M I G S!" : "N O N - M I G S!";

								memberDataTable = $(".memberDataTable").clone();
								memberDataTable.removeClass("memberDataTable").removeClass("hide");

								memberDataTable.find(".memberName").text(data.name);
								
								memberDataTable.find(".pbData").text(data.pbno).addClass(data.pbno == "No Data" ? "labelGray" : "labelGreen");
								
								memberDataTable.find(".memidData").text(data.memid).addClass(data.memid == "No Data" ? "labelGray" : "labelGreen");

								memberDataTable.find(".statusData").text(memberStatus).addClass(data.status == "MIGS" ? "labelGreen" : "labelRed");
								
								if(data.status == "MIGS"){
									memberDataTable.find(".nonmigsLabel").remove();
									memberDataTable.find(".nonmigsBtn").remove();
								}else{
									memberDataTable.find(".voteBtn").remove();
								}

								if(res.electionStatus == "closed"){
									memberDataTable.find(".voteBtn").remove();
								}

								memberDataTable.find(".nonmigsBtn").click((e) => {
									$("#nonmigsForm").find("input[name='id']").val(data.id);
									$("#nonmigsForm").find("input[name='pbno']").val(data.pbno != "No Data" ? data.pbno : "");
									$("#nonmigsForm").find("input[name='memid']").val(data.memid != "No Data" ? data.memid : "");
									$("#nonmigsForm").find("input[name='name']").val(data.name);
									$("#nonmigsForm").find("input[name='bday']").val(data.bday);
									$("#nonmigsForm").find("input[name='branch']").val(data.branch);
									$("#nonmigsForm").find("input[name='status']").val(data.status);
									$(".nonmigsNameLabel").text(data.name);
								});
								
								memberDataTable.find(".voteBtn").click((e) => {
									localStorage.setItem("memberID",data.id);
									if(data.pbno != "No Data"){
										localStorage.setItem("pbno",data.pbno);
									}else{
										localStorage.setItem("pbno",data.memid);
									}
									window.location.href = "novadeci-election";
								});

								$(".memberContainer").append(memberDataTable);
							});
						}else{
							$(".noRecordTable").removeClass("hide");
						}
					}
				});
			});

			$("#nonmigsForm").submit((e) => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'add_verification.php',
					data: $(e.currentTarget).serializeArray(),
					dataType: 'json',
					success: function(res){
						swal({
							text: res.message,
							title: res.status == "success" ? "SAVE" : "WARNING",
							icon: res.status == "success" ? "success" : "warning",
							allowOutsideClick: false
						})
						.then(() => {
							$("#nonmigsForm").find("input[name='id']").val("");
							$("#nonmigsForm").find("input[name='pbno']").val("");
							$("#nonmigsForm").find("input[name='memid']").val("");
							$("#nonmigsForm").find("input[name='name']").val("");
							$("#nonmigsForm").find("input[name='bday']").val("");
							$("#nonmigsForm").find("input[name='branch']").val("");
							$("#nonmigsForm").find("input[name='status']").val("");
							$(".nonmigsNameLabel").text("");
							$("#nonmigsForm").find("input[name='contact_no']").val("");
							$("#update_modal").modal('hide');
						});
					}
				});
			});
		</script>
	</body>
</html>