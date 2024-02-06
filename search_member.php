<?php
	require 'conn.php';
	$dateTime = new DateTime();
    $dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));

	if(ISSET($_POST['search'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width-device-width, initial-scale=1"/>
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
		</style>
	</head>
<body>
<table class="table table-striped">
			<?php			
				$keyword = $_POST['keyword'];
				// $query = mysqli_query($conn, "SELECT * FROM `voters` WHERE `pbno` LIKE '%$keyword%' OR `memid` LIKE '%$keyword%'");
				$query = mysqli_query($conn, "SELECT * FROM `voters` WHERE `pbno`='$keyword' OR `memid`='$keyword'");
				$count = mysqli_num_rows($query);

				if($count > 0){
					while($fetch = mysqli_fetch_array($query)){
						// $_SESSION['migs_pbno'] = $fetch['pbno'];

						$checkGiveAwayQuery = "SELECT * from giveaways_record where voters_id = '". $fetch['id']."'";
						$checkQuery = $conn->query($checkGiveAwayQuery);
						$gaData = $checkQuery->fetch_assoc();

			?>
			<thead class="alert alert-warning">
					<tr class="alert alert-info">
						<td style='font-size:25px;text-align:center;'><?php echo $fetch['firstname']." ". $fetch['middlename']." ". $fetch['lastname'] ?></td>
					</tr>
					<tr class="alert alert-success">
						<?php
					
    						$parse = parse_ini_file('novadeci-election/admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
    						$title = $parse['election_title'];
    						$start_time = $parse['election_start_time'];
    						$end_time = $parse['election_end_time'];
							$start_date = $parse['election_start_date'];
							$end_date = $parse['election_end_date'];

							if($fetch['isregistered']=='0' AND $fetch['status']=='MIGS') : 
							
								if(isset($_SESSION['frontAccountIsLogin']) && $_SESSION['frontAccountIsLogin'] == "loggedIn") :
									
									if(!$gaData) : 
						?> 
								
										<div class="modal show" id="isMIGsGiveawayModal">
											<div class="modal-dialog modal-md">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"
														onclick = "$('.modal').removeClass('show').addClass('fade');">
														<span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title"><b>Giveaways</b></h4>
													</div>
													<form method="POST" action="#" enctype="multipart/form-data">
														<div class="modal-body">
															<input type="hidden" name="mem_IDx" value="<?= $fetch['id']?>">
															<div class="row">
																<div class="col-md-12">
																	<label class="control-label text-success">CASH INCENTIVES:</label>
																	<input type="number" class="form-control" min="200" max="400" value="200" name="cash_incentives" placeholder="200 cash for Face to Face">
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<label class="control-label text-success" style="margin-top:5px">SUPPLIES:</label>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6" style="margin-left:25px">
																	<div class="form-check">
																		<label class="form-check-label" for="s_tshirt">
																			T-shirt
																		</label>
																		<input class="form-check-input" type="checkbox" name="s_tshirt" id="s_tshirt" value="tshirt" checked>
																	</div>
																	<div class="form-check">
																		<label class="form-check-label" for="s_eco">
																			Ecobag
																		</label>
																		<input class="form-check-input" type="checkbox" name="s_eco" id="s_eco" value="ecobag" checked>
																	</div>
																	<div class="form-check">
																		<label class="form-check-label" for="s_calen">
																			Calendar
																		</label>
																		<input class="form-check-input" type="checkbox" name="s_calen" id="s_calen" value="calendar" checked>
																	</div>
																	<div class="form-check">
																		<label class="form-check-label" for="s_annual">
																			Annual Book
																		</label>
																		<input class="form-check-input" type="checkbox" name="s_annual" id="s_annual" value="annual_book" checked>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary btn-flat" name="gaBtn"><i class="fa fa-save"></i> Save</button>
														</div>
													</form>
												</div>
											</div>
										</div>
							    
						<?php
							    	endif;
							    endif;

								$currentDay = $dateTime->format("Y-m-d");
								$electionDayStatus = date("Y-m-d", strtotime($start_date)) <= $dateTime->format("Y-m-d") && date("Y-m-d", strtotime($end_date)) >= $dateTime->format("Y-m-d");
								
								$electionStartTime = new DateTime(date("Y-m-d h:i A", strtotime($currentDay." ".$start_time)));

								$electionEndTime = new DateTime(date("Y-m-d h:i A", strtotime($currentDay." ".$end_time)));

								$currentDateTime = new DateTime($dateTime->format("Y-m-d h:i A"));

								$electionTimeStatus =  $electionStartTime <= $currentDateTime && $electionEndTime >= $currentDateTime;
								
								$pbno_label = $fetch['pbno'];
								$label = "PB#";
								if(empty($fetch['pbno'])){
								   $pbno_label = $fetch['memid']; 
								   $label = "MemID";
								}
								if($electionDayStatus && $electionTimeStatus)
								{
									echo "<td style='font-size:25px;'>
											<center>
												<label style='color:green'>  M I G S!  </label>
												<br />
												<label style='color:blue;font-size:14px;'>  Tandaan ang iyong ".$label."<label style='color:red;font-size:24px;'>".$pbno_label."</label> ito ang gagamitin sa pag sign-in sa voting! </label>
												<br />
												
												 <a href='novadeci-election' data-pbno='".$fetch['pbno']."' class='voteBtn'>
								 					<label style='font-size:20px;color:purple;cursor:pointer'> >>> Click here to VOTE <<< </label>
												</a>
												
											</center>
										</td>";
									
								} else {
									// echo "<td style='font-size:25px;'>
    								// 		<center>
									// 			<label style='color:black'>PB#/MemID: </label>
									// 			<label style='color:green'>".$fetch['pbno']."</label>
									// 			<br/>
    								// 			<label style='color:green'>  M I G S!  </label>
    								// 			<br />
    								// 				<label style='font-size:16px;color:red;cursor:pointer'> >>> Voting is no longer accessible <<< </label>
    								// 		</center>
    								// 	</td>";

										echo "<td style='font-size:25px;'>
										<center>
											<label style='color:black'>".$label.": </label>
											<label style='color:green'>".$pbno_label."</label>
											<br/>
											<label style='color:green'>  M I G S!  </label>
										</center>
									</td>";
								}	
								
							endif;
							if($fetch['isregistered']=='0' AND $fetch['status']=='NONMIGS'){
							    $pbno_label = $fetch['pbno'];
								$label = "PB#";
								if(empty($fetch['pbno'])){
								   $pbno_label = $fetch['memid']; 
								   $label = "MemID";
								}
								echo "<td style='font-size:25px;'>
								<center>
								<label style='color:black'>".$label.": </label>
								<label style='color:green'>".$pbno_label."</label>
								<br />
								<label style='color:red'>  N O N - M I G S!  </label>
								<br /><label style='font-size:20px;color:purple;'> Makipag ugnayan sa inyong account officer(AO)</label>
								<label style='font-size:20px;color:blue;cursor:pointer' data-toggle='modal' data-target='#update_modal".$fetch['id']."'> >> Please click here << </label>
								</center></td>";
							}
							elseif($fetch['isregistered']=='1'){
							     echo "<td style='font-size:25px;'><center><label>ALREADY VOTED!</label><br />
									<label style='font-size:14px;color:blue'><b><i>Here's your </i>Zoom credentials<i> for the 46th General Assembly Virtual Meeting <br> to be held on </i>March 18, ".date('Y').":</b></label><br />

									<label style='font-size:14px;color:purple'><b>Time</b>&nbsp; (08:00 am - 12:00 pm)</label>
									<br>
									<div class='row'>
										<div class='col-sm-6'>
											<label style='font-size:12px;color:purple'>Meeting ID (#1): &nbsp;<input type='text' value='859 9799 6595' id='meeting_id1' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionMeetID1()' class='btn btn-info btn-work2'>Copy</button></label>
											<label style='font-size:12px;color:purple'>Passcode (#1): &nbsp;<input type='text' value='GA2023' id='passcode1' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionPassCode1()' class='btn btn-info btn-work2'>Copy</button></label>
										</div>
										<div class='col-sm-6'>
											<label style='font-size:12px;color:purple'>Meeting ID (#2): &nbsp;<input type='text' value='820 5449 2986' id='meeting_id2' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionMeetID2()' class='btn btn-info btn-work2'>Copy</button></label>
											<label style='font-size:12px;color:purple'>Passcode (#2): &nbsp;<input type='text' value='780393' id='passcode2' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionPassCode2()' class='btn btn-info btn-work2'>Copy</button></label>
										</div>
									</div>
								</center></td>";
							}
						?>
					</tr>
					<?php	include 'add_verification.php'; ?>
			<?php
					}
				}else{
					echo "<tr><td colspan='2' class='text-danger' style='font-size:24px;'><center><b>NO RECORD FOUND!</b><br />
					<label style='font-size:16px;color:purple'><u>Please Call these Hotline:</u><br />
					<span class='' style='size:16px;text-align:center;color:brown'>
					
	<pre>
    0917-8766-802 (Lagro Office)   &nbsp;&nbsp;
    0917-6219-412 / (2)7115041 (Bulacan Office) &nbsp;&nbsp;
    0917-6233-640 / 0917-8766-794 (Fairview Office)&nbsp;&nbsp;
    0917-8350-689 / 0933-8673-779 (Kiko Office)    &nbsp;&nbsp;
    0917-8766-782 / 896-204-26 (Camarin Office) &nbsp;&nbsp;
    0917-8766-797 / 0933-8673-768 (Cubao Office)    &nbsp;&nbsp;
    0917-6312-915 / 0933-8673-777 (BSilang Office) &nbsp;&nbsp;
    0917-620-3141 (Main Office)    &nbsp;&nbsp;
    0917-620-2749 (Main Office)    &nbsp;&nbsp;
    0917-620-2618 (Main Office)    &nbsp;&nbsp;
    0917-876-6795 (Main Office)    &nbsp;&nbsp;
    0933-8673-769 / 0917-8766-796 (Tsora Office) &nbsp;&nbsp;
    </pre>
					
				
					</span></label>
					</center></td></tr>";
				}
			?>
	</table>
<?php
	}
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
	function myFunctionMeetID1() {
		var copyText = document.getElementById("meeting_id1");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
	}
	function myFunctionPassCode1() {
		var copyText = document.getElementById("passcode1");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
	}
	function myFunctionMeetID2() {
		var copyText = document.getElementById("meeting_id2");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
	}
	function myFunctionPassCode2() {
		var copyText = document.getElementById("passcode2");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
	}

	$('button[name="gaBtn"]').on('click', function(e){
		e.preventDefault()

		var memidx = $('input[name="mem_IDx"]').val()
		var cashx = $('input[name="cash_incentives"]').val()
		var tshirtx = $('input[name="s_tshirt"]').is(":checked") ? true : false
		var ecox = $('input[name="s_eco"]').is(":checked") ? true : false
		var calenx = $('input[name="s_calen"]').is(":checked") ? true : false
		var abookx = $('input[name="s_annual"]').is(":checked") ? true : false
		
		$.ajax({
			type: 'POST',
			url: 'giveaway_store.php',
			data: {mem_idx:memidx,action:'save',cash:cashx,tshirt:tshirtx,eco:ecox,calen:calenx,abook:abookx},
			success: function(response){
				if(response == 'success'){
					$('#isMIGsGiveawayModal').removeClass('show')
					reloadGiveAways()
					alert('Giveaway Saved.')
				}
			}
		})
	})


	function reloadGiveAways(){
		$.ajax({
			type: 'POST',
			url: 'giveaway_store.php',
			data: {action:'reloadCounter'},
			dataType: 'json',
			success: function(response){
				$('#count1').text(response[0].tshirt || 0)
				$('#count2').text(response[1].ecobag || 0)
				$('#count3').text(response[2].calendar || 0)
				$('#count4').text(response[3].annual_book || 0)
				$('#count5').text(response[4].pre_ga_voted || 0)
			}
		})
	}

	reloadGiveAways()

	$(".voteBtn").click((e) => {
		e.preventDefault();
		let pbno = $(e.currentTarget).data("pbno");
		localStorage.setItem("pbno",pbno);
		window.location = "/novadeci-election";
	});
</script>
</body>
</html>
