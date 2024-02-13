<?php
include_once 'config/Database.php';
include_once 'class/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if(!$user->loggedIn()) {
	header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap-3.3.5.min.css">
    <link rel="icon" href="icon/favicon.ico">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap-3.3.5.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
    <title>VERIFICATION LIST</title>
</head>
<body>
    <?php include "menus.php"; ?>
    <br>
    <section id="main">
        <div class="container">
            <div class="row">
                <?php include "left_menus.php"; ?>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:green;color:white;">
                            <h3 class="panel-title">FOR VERIFICATION LIST</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <?php
											if(isset($_SESSION['error'])){
												echo
												"
												<div class='alert alert-danger text-center'>
													<button class='close'>&times;</button>
													".$_SESSION['error']."
												</div>
												";
												unset($_SESSION['error']);
											}
											if(isset($_SESSION['success'])){
												echo
												"
												<div class='alert alert-success text-center'>
													<button class='close'>&times;</button>
													".$_SESSION['success']."
												</div>
												";
												unset($_SESSION['success']);
											}
										?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <th>PB#</th>
                                        <th>MemID</th>
                                        <th width="25%">Name</th>
                                        <th>BirthDate</th>
                                        <th>Contact#</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th width="20%">Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once('conn.php');
                                            $sql = "SELECT * FROM nonmigs";
                                            $query = $conn->query($sql);
                                            while($row = $query->fetch_assoc()){

                                                $status = $row['verification_stat'];
                                                $date = date("m/d/Y H:i A", strtotime($row['date']));

                                                if($status=="Verified")
                                                {
                                                    $color="color:green";
                                                }
                                                else if($status=="Pending")
                                                {
                                                    $color="color:red";
                                                }
                                                else
                                                {
                                                    $color="color:orange";
                                                }
                                                echo
                                                "<tr>
                                                    <td>".$row['pbnum']."</td>
                                                    <td>".$row['memid']."</td>
                                                    <td>".$row['name']."</td>
                                                    <td>".$row['bday']."</td>
                                                    <td>".$row['contact_no']."</td>
                                                    <td>".$row['branch']."</td>
                                                    <td style='$color'>".$row['verification_stat']."</td>
                                                    <td>".$date."</td>
                                                    <td>
                                                        <a href='#edit_".$row['id']."' class='btn btn-warning btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span></a>

                                                    </td>
                                                </tr>";
                                                include('edit_delete_modal.php');
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
        
        //hide alert
        $(document).on('click', '.close', function(){
            $('.alert').hide();
        });
    </script>
</body>
</html>