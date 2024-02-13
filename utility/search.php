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
    <link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
    <link rel="stylesheet" href="css/bootstrap-3.3.5.min.css">
    <link rel="icon" href="icon/favicon.ico">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap-3.3.5.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/dashboard_style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>UPDATE MEMBER'S STATUS</title>
</head>
<body>
    <?php include "menus.php"; ?>
    <br>

    <section>
        <div class="container">
            <div class="row">
                <?php include "left_menus.php"; ?>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:green;color:white;">
                            <h3 class="panel-title">UPDATE MEMBER'S STATUS</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 well" style="background-color: #ffffff;">
                                <form method="POST" action="">
									<div class="form-inline pull-right">
										<input type="text" class="form-control" name="search" placeholder="PB# / MemID / Name" required="required"/>
										<button class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Search</button> &nbsp;&nbsp;&nbsp;<a href="search.php"><span class="glyphicon glyphicon-refresh" style="font-size:18px;"></span></a>
									</div>
								</form>
                                <br />
                                <br />
                                <?php include 'search_member.php'?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready((e) => {
           let memberCtr = $("#updateStatusTable").data("member");
           if(memberCtr == "found"){
                $("#updateStatusTable").removeClass("hide");
                $("#noRecordTable").addClass("hide");
           }

           if(memberCtr == "not found"){
                $("#updateStatusTable").addClass("hide");
                $("#noRecordTable").removeClass("hide");
           }
        });

        $(".updateStatusForm").submit((e) => {
            e.preventDefault();
            let dataID = $(e.currentTarget).find("input[name='id']").val();
            let data = $(e.currentTarget).serializeArray();
            $.ajax({
					type: 'POST',
					url: 'update_query.php',
					data: $(e.currentTarget).serializeArray(),
					dataType: 'json',
					success: function(res){
                        if(res.status == "success"){
                            swal({
                                text: res.message,
                                title: res.status == "success" ? "SAVE" : "WARNING",
                                icon: res.status == "success" ? "success" : "warning",
                                allowOutsideClick: false
                            })
                            .then(() => {
                                $("#trStatus-"+data[0].value).find(".label-info").text(data[2].value);
                                $(".updateStatusModal").modal('hide');
                            });
                        }
					}
				});
        });
    </script>
</body>
</html>