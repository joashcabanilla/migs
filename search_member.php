<?php
	require 'conn.php';
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
				$query = mysqli_query($conn, "SELECT * FROM `voters` WHERE pbno='$keyword' OR memid='$keyword' LIMIT 1") or die(mysqli_error());
				// $query = mysqli_query($conn, "SELECT * FROM `voters` WHERE `pbno` LIKE '%$keyword%' LIMIT 1") or die(mysqli_error());
				$count = mysqli_num_rows($query);
				if($count > 0){
					while($fetch = mysqli_fetch_array($query)){
						
						$_SESSION['migs_pbno'] = $fetch['pbno'];

						$checkGiveAwayQuery = "SELECT * from giveaways_record where voters_id = '". $fetch['id']."'";
						$checkQuery = $conn->query($checkGiveAwayQuery);
						$gaData = $checkQuery->fetch_assoc();

			?>
			<thead class="alert alert-warning">
					<tr class="alert alert-info">
						<td style='font-size:25px;text-align:center;'><?php echo $fetch['firstname']." ". $fetch['middlename']." ". $fetch['lastname']?></td>
					</tr>
					<tr class="alert alert-success">
						<?php
					
    						$parse = parse_ini_file('novadeci-election/admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
    						$title = $parse['election_title'];
    						$start_time = $parse['election_start_time'];
    						$end_time = $parse['election_end_time'];

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
															<!-- <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"
															onclick = "$('.modal').removeClass('show').addClass('fade');"><i class="fa fa-close"></i> Close</button> -->
															<button type="submit" class="btn btn-primary btn-flat" name="gaBtn"><i class="fa fa-save"></i> Save</button>
														</div>
													</form>
												</div>
											</div>
										</div>
							    
						<?php
							    	endif;
							    endif;

								if(date('h:i A', strtotime($start_time) - 60*60*8) < date("h:i A") && date('h:i A', strtotime($end_time) - 60*60*8) > date("h:i A"))
								{
									echo "<td style='font-size:25px;'>
    										<center>
    											<label style='color:green'>  M I G S!  </label>
    											<br />
    											<a href='#'>
    												<label style='font-size:16px;color:red;cursor:pointer'> >>> Voting is no longer accessible <<< </label>
    											</a>
    										</center>
    									</td>";
									
								} else {
									echo "<td style='font-size:25px;'>
											<center>
												<label style='color:green'>  M I G S!  </label>
												<br />
												<label style='color:blue;font-size:14px;'>  Tandaan ang iyong old PB#/MemID <label style='color:red;font-size:24px;'>".$fetch['pbno']."</label> ito ang gagamitin sa pag sign-in sa voting! </label>
												<br />
												
												 <a href='novadeci-election'>
								 					<label style='font-size:20px;color:purple;cursor:pointer'> >>> Click here to VOTE <<< </label>
												</a>
												
											</center>
										</td>";
								}	
								
							endif;
							if($fetch['isregistered']=='0' AND $fetch['status']=='NON-MIGS'){

								echo "<td style='font-size:25px;'><center><label style='color:red'>  N O N - M I G S!  </label>
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
							    
								// echo "<td style='font-size:25px;'><center><label>ALREADY VOTED!</label><br />
                				// 					<label style='font-size:14px;color:blue'><b>Please select your preffered slot for the 46th General Assembly Virtual Meeting to be held on March 19, 2022:</b></label><br />
                
                				// 					<label style='font-size:14px;color:brown'><b>Morning Session</b>&nbsp; (8:00 am - 12:00 noon)</label>
                				// 					<label style='font-size:12px;color:brown'>Meeting ID: &nbsp;<input type='text' value='861 2002 7759' id='meeting_id1' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionMeetID1()' class='btn btn-info btn-work'>Copy</button></label>
                				// 					<label style='font-size:12px;color:brown'>&nbsp;&nbsp;Passcode: &nbsp;<input type='text' value='320812' id='passcode1' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionPassCode1()' class='btn btn-info btn-work'>Copy</button></label>
                				// 					<hr class='new2'/>
                				// 					<label style='font-size:14px;color:purple'><b>Afternoon Session</b>&nbsp; (1:00 pm - 5:00 pm)</label>
                				// 					<label style='font-size:12px;color:purple'>Meeting ID: &nbsp;<input type='text' value='814 1050 3867' id='meeting_id2' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionMeetID2()' class='btn btn-info btn-work2'>Copy</button></label>
                				// 					<label style='font-size:12px;color:purple'>&nbsp;&nbsp;Passcode: &nbsp;<input type='text' value='639297' id='passcode2' style='height:20px;width:90px;font-size:12px;'>&nbsp;<button onclick='myFunctionPassCode2()' class='btn btn-info btn-work2'>Copy</button></label>
                				// 				</center>
    								
    							// </td>";
							}
						?>
					</tr>
			<?php
					}
				}else{
					echo "<tr><td colspan='2' class='text-danger' style='font-size:24px;'><center><b>NO RECORD FOUND!</b><br />
					<label style='font-size:16px;color:purple'><u>Please Call these Hotline:</u><br />
					<span class='' style='size:16px;text-align:center;color:brown'>
					
	<pre>
    0917-876-6802 (Lagro Office)   &nbsp;&nbsp;
    0917-621-9412 (Bulacan Office) &nbsp;&nbsp;
    0917-623-3640 (Fairview Office)&nbsp;&nbsp;
    0917-713-9448 (Kiko Office)    &nbsp;&nbsp;
    0917-876-6792 (Camarin Office) &nbsp;&nbsp;
    0917-876-6800 (BSilang Office) &nbsp;&nbsp;
    0917-620-3141 (Main Office)    &nbsp;&nbsp;
    0917-620-2749 (Main Office)    &nbsp;&nbsp;
    0917-620-2618 (Main Office)    &nbsp;&nbsp;
    0917-876-6795 (Main Office)    &nbsp;&nbsp;
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
</script>
</body>
</html>
