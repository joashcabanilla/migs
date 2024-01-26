<?php
	
	include 'includes/session.php';
	include 'includes/slugify.php';

	$output = array('error'=>false,'list'=>'');

	$sql = "SELECT * FROM positions";
	$query = $conn->query($sql);

	while($row = $query->fetch_assoc()){
		$position = slugify($row['description']);
		$pos_id = $row['id'];
		if(isset($_POST[$position])){
			if($row['max_vote'] > 1){
				if(count($_POST[$position]) > $row['max_vote']){
					$output['error'] = true;
					$output['message'][] = '<li>You can only choose '.$row['max_vote'].' candidates for '.$row['description'].'</li>';
				}
				else{
					$des = null;

					foreach($_POST[$position] as $key => $values){
						$sql = "SELECT * FROM candidates WHERE id = '$values'";
						$cmquery = $conn->query($sql);
						$cmrow = $cmquery->fetch_assoc();
						$image = (!empty($cmrow['photo'])) ? 'images/'.$cmrow['photo'] : 'images/profile.jpg';
						$description = $des == $row['description'] ? '' : $row['description'].':';

						$output['list'] .= "
						<div class='row votelist'>
							  <span class='col-sm-12'>
								<span class=''>
									<b>".$description."</b>
								</span>
							</span> 
						</div>
						<div class='row'>
							<div class='text-center'>
								<img src='$image' height='100px' width='100px'>
								<br>
								<span>".$cmrow['firstname']." ".$cmrow['lastname']."</span>
							</div>
						</div>";

						$des = $row['description'];
					}

				}
				
			}
			else{
				$candidate = $_POST[$position];
				$sql = "SELECT * FROM candidates WHERE id = '$candidate'";
				$csquery = $conn->query($sql);
				$csrow = $csquery->fetch_assoc();
				$image = (!empty($csrow['photo'])) ? 'images/'.$csrow['photo'] : 'images/profile.jpg';
				$output['list'] .= "
					<div class='row votelist'>
						<span class='col-sm-12'>
							<span class=''>
								<b>".$row['description']." :</b>
							</span>
						</span> 
					</div>
					<div class='row'>
						<div class='text-center'>
							<img src='$image' height='100px' width='100px'>
							<br>
							<span>".$cmrow['firstname']." ".$cmrow['lastname']."</span>
						</div>
					</div>
				";
			}

		}
		
	}

	echo json_encode($output);


?>