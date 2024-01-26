<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	      	<?php
	      		$parse = parse_ini_file('admin_nvdc/config.ini', FALSE, INI_SCANNER_RAW);
    			$title = $parse['election_title'];
	      	?>
	      	<!--<h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>-->
	        <div class="row">
				<div class="col-sm-10 col-sm-offset-1">
	        		<?php
				        if(isset($_SESSION['error']) && $_SESSION['error']){
				        	?>
				        	<div class="alert alert-danger alert-dismissible">
				        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<ul>
					        		<?php
					        			foreach($_SESSION['error'] as $error){
					        				echo "
					        					<li>".$error."</li>
					        				";
					        			}
					        		?>
					        	</ul>
					        </div>
				        	<?php
				         	unset($_SESSION['error']);

				        }
				        if(isset($_SESSION['success'])){
				          	echo "
				            	<div class='alert alert-success alert-dismissible dontPrint'>
				              		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				              		<h4><i class='icon fa fa-check'></i> Success!</h4>
				              	".$_SESSION['success']."
				            	</div>
				          	";
				          	unset($_SESSION['success']);
				        }

				    ?>

				    <div class="alert alert-danger alert-dismissible dontPrint" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>

				    <?php
				    	$sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
				    	$vquery = $conn->query($sql);
				    	if($vquery->num_rows > 0){
							$name = substr($voter['lastname'] .', '. $voter['firstname'], 0, 30);
				    		?>
				    		<div class="text-center">
					    		<h3>You have already voted for this election.</h3>
								<?php 
									if($voter['ticket']) : ?>
										<h3>THIS IS YOUR RAFFLE TICKET</h3>

										<div style="position: relative;" class="text-center tixwithimg">
											<img src="images/raffle_front.jpg" alt="tix" style="width: 50%; border: 1px dashed">
												
											<!-- <table style="position: absolute; transform: rotate(-90deg); bottom:30%; left:-8%">
												<tr>
													<td style="text-align:left"><label></label></td>
													<td style="text-align:left"><label></label></td>
													<td style="border-bottom: 1px solid !important;"><span class="tixNo" style="color:red"><?= $voter['ticket'] ?></span></td>
												</tr>
												<tr>
													<td style="text-align:left"><label>MEM ID/PB#: </label></td>
													<td style="border-bottom: 1px solid !important;"><?= $voter['pbno'] ?></td>
													<td></td>
												</tr>
												<tr>
													<td style="text-align: left"><label>NAME: </label></td>
													<td style="border-bottom: 1px solid !important;">
														<?= 
															strlen($name) >= 30 ? strtoupper($name) . '...' : strtoupper($name);
														?>
													</td>
													<td></td>
												</tr>
												<tr>
													<td style="text-align: left"><label>CONTACT NO.: </label></td>
													<td style="border-bottom: 1px solid !important;"><?= $voter['contact_no'] ?></td>
													<td></td>
												</tr>
												<tr>
													<td style="text-align: left"><label>SIGNATURE: </label></td>
													<td style="border-bottom: 1px solid !important;"></td>
													<td></td>
												</tr>
											</table> -->
											<div class="divTop tixNo" style="position: absolute; bottom: 1%; right: 30%; font-weight: bold; color:red">
												<?= $voter['ticket'] ?>
											</div>
										</div>
										<br class="dontPrint">
										<br class="dontPrint">

										<div class="text-center">
											<a href="#view" data-toggle="modal" class="btn btn-flat btn-success btn-lg dontPrint">View Ballot</a>
											<button class="btn btn-flat btn-success btn-lg dontPrint" onclick={window.print()}>Print</button>
										</div> <br>
									
									<?php else : ?>
										<div class="text-center">
											<a href="#view" data-toggle="modal" class="btn btn-flat btn-success btn-lg dontPrint">View Ballot</a>
										</div>
									<?php endif ?>
								<h4 style="color:purple;"><b><i>Here's your</i> Zoom Credentials <i>for the 46th General Assembly Virtual Meeting to be held on</i> March 18, <?= date('Y')?>:</b></h4>
								<h4><b>Time</b> <br />(08:00 am - 12:00 pm)</h4>
								<div class="row">
									<div class="col-sm-6">
										<h5>Meeting ID (#1): &nbsp;
											<input type="text" value="859 9799 6595" id="meeting_id1" style="height:30px;width:152px;font-size:14px;">&nbsp;
											<!-- <input type="text" value="854 4455 6895" id="meeting_id1" style="height:30px;width:152px;font-size:14px;">&nbsp; -->
											<button onclick="myFunctionMeetID1()" class="btn btn-info dontPrint" >Copy</button></h5>
										<h5>&nbsp;&nbsp;Passcode (#1): &nbsp;
										<input type="text" value="GA2023" id="passcode1" style="height:30px;width:152px;font-size:14px;">&nbsp;
										<!-- <input type="text" value="159822" id="passcode1" style="height:30px;width:152px;font-size:14px;">&nbsp; -->
										<button onclick="myFunctionPassCode1()" class="btn btn-info dontPrint" >Copy</button></h5>
									</div>
									<div class="col-sm-6">
										<h5>Meeting ID (#2): &nbsp;
											<input type="text" value="820 5449 2986" id="meeting_id2" style="height:30px;width:152px;font-size:14px;">&nbsp;
											<button onclick="myFunctionMeetID2()" class="btn btn-info dontPrint" >Copy</button></h5>
										<h5>&nbsp;&nbsp;Passcode (#2): &nbsp;
											<input type="text" value="780393" id="passcode2" style="height:30px;width:152px;font-size:14px;">&nbsp;
											<button onclick="myFunctionPassCode2()" class="btn btn-info dontPrint" >Copy</button></h5>
									</div>
								</div>
								
							

									<!--<a href="#view" data-toggle="modal" class="btn btn-flat btn-success btn-lg">View Ballot</a><br />-->
									<!--		<h4 style="color:purple;"><b>Please select your preffered slot for the 46th General Assembly Virtual Meeting to be held on March 19, 2022:</b></h4>-->
									<!--		<h4><b>Morning Session</b> <br />(8:00 am - 12:00 noon)</h4>-->
									<!--		<h5>Meeting ID: &nbsp;<input type="text" value="861 2002 7759" id="meeting_id1" style="height:30px;width:152px;font-size:14px;">&nbsp;<button onclick="myFunctionMeetID1()" class="btn btn-info" >Copy</button></h5>-->
									<!--		<h5>&nbsp;&nbsp;Passcode: &nbsp;<input type="text" value="320812" id="passcode1" style="height:30px;width:152px;font-size:14px;">&nbsp;<button onclick="myFunctionPassCode1()" class="btn btn-info" >Copy</button></h5>-->

									<!--		<h4><b>Afternoon Session</b> <br />(1:00 pm - 5:00 pm)</h4>-->
									<!--		<h5>Meeting ID: &nbsp;<input type="text" value="814 1050 3867" id="meeting_id2" style="height:30px;width:152px;font-size:14px;">&nbsp;<button onclick="myFunctionMeetID2()" class="btn btn-info" >Copy</button></h5>-->
									<!--		<h5>&nbsp;&nbsp;Passcode: &nbsp;<input type="text" value="639297" id="passcode2" style="height:30px;width:152px;font-size:14px;">&nbsp;<button onclick="myFunctionPassCode2()" class="btn btn-info" >Copy</button></h5>-->
							<!-- <i>or click here <a href='#'>&nbsp;&nbsp;<label style='font-size:18px;color:purple;cursor:pointer'> >>> 44th NOVADECI General Assembly <<<</i></label></a> -->

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

									</script>





								</div>
				    		<?php
				    	}
				    	else{
				    		?>
			    			<!-- Voting Ballot -->
						    <form method="POST" id="ballotForm" action="submit_ballot.php">
				        		<?php
				        			include 'includes/slugify.php';

				        			$candidate = '';
				        			$sql = "SELECT * FROM positions ORDER BY priority ASC";
									$query = $conn->query($sql);
									while($row = $query->fetch_assoc()){
										$sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."' order by RAND()";
										$cquery = $conn->query($sql);
										while($crow = $cquery->fetch_assoc()){
											$slug = slugify($row['description']);
											$checked = '';
											if(isset($_SESSION['post'][$slug])){
												$value = $_SESSION['post'][$slug];

												if(is_array($value)){
													foreach($value as $val){
														if($val == $crow['id']){
															$checked = 'checked';
														}
													}
												}
												else{
													if($value == $crow['id']){
														$checked = 'checked';
													}
												}
											}
											$input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
											$image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
											$candidate .= '
												<li>
													'.$input.'<img src="'.$image.'" height="100px" width="100px" class="clist"><span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
												</li>
											';
										}

										$instruct = ($row['max_vote'] > 1) ? 'You may select up to '.$row['max_vote'].' candidates' : 'Select only one candidate';

										echo '
											<div class="row">
												<div class="col-xs-12">
													<div class="box box-solid" id="'.$row['id'].'">
														<div class="box-header with-border">
															<h3 class="box-title"><b>'.$row['description'].'</b></h3>
														</div>
														<div class="box-body">
															<p>'.$instruct.'
																<span class="pull-right">
																	<button type="button" class="btn btn-warning btn-sm btn-flat reset" data-desc="'.slugify($row['description']).'"><i class="fa fa-refresh"></i> Reset</button>
																</span>
															</p>
															<div id="candidate_list">
																<ul>
																	'.$candidate.'
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										';

										$candidate = '';

									}

				        		?>
				        		<div class="text-center">
					        		<button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button>
					        		<button type="submit" class="btn btn-success btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
					        	</div>
				        	</form>
				        	<!-- End Voting Ballot -->
				    		<?php
				    	}

				    ?>

	        	</div>
	        </div>
	      </section>

	    </div>
	  </div>

  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
	$(function(){
		$('.content').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});

		$(document).on('click', '.reset', function(e){
			e.preventDefault();
			var desc = $(this).data('desc');
			$('.'+desc).iCheck('uncheck');
		});

		$(document).on('click', '.platform', function(e){
			e.preventDefault();
			$('#platform').modal('show');
			var platform = $(this).data('platform');
			var fullname = $(this).data('fullname');
			$('.candidate').html(fullname);
			$('#plat_view').html(platform);
		});

		$('#preview').click(function(e){
			e.preventDefault();
			var form = $('#ballotForm').serialize();
			if(form == ''){
				$('.message').html('You must vote atleast one candidate');
				$('#alert').show();
			}
			else{
				$.ajax({
					type: 'POST',
					url: 'preview.php',
					data: form,
					dataType: 'json',
					success: function(response){
						if(response.error){
							var errmsg = '';
							var messages = response.message;
							for (i in messages) {
								errmsg += messages[i];
							}
							$('.message').html(errmsg);
							$('#alert').show();
						}
						else{
							$('#preview_modal').modal('show');
							$('#preview_body').html(response.list);
						}
					}
				});
			}

		});

		$(document.body).on('click', 'button[name="vote"]', function(e){
			e.preventDefault();
			$('button[name="vote"]').attr('disabled', 'disabled')

			var input = $("<input>").attr("type", "hidden")
									.attr("name", "vote").val(true);
							
			const rndInt = Math.floor(Math.random() * 3) + 1

			let timerInterval

			Swal.fire({
				title: 'Submitting Vote, \n\rPlease Wait...',
				html: 'Auto close in <b></b> milliseconds.',
				timer: rndInt + '000',
				timerProgressBar: true,
				allowOutsideClick: false,
				didOpen: () => {
					Swal.showLoading()
					const b = Swal.getHtmlContainer().querySelector('b')
					timerInterval = setInterval(() => {
					b.textContent = Swal.getTimerLeft()
					}, 100)
				},
				willClose: () => {
					clearInterval(timerInterval)
					$('#ballotForm').append(input).submit()
				}

				}).then((result) => {
				/* Read more about handling dismissals below */
				if (result.dismiss === Swal.DismissReason.timer) {
					// console.log('I was closed by the timer')
				}
			})
			
		})

	});
</script>
</body>
</html>
