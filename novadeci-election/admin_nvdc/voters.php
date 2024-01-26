<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<?php  include "config/db-config.php";?>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">

            <?php include 'includes/navbar.php'; ?>
            <?php include 'includes/menubar.php'; ?>

            <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Voters
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Voters</li>
                </ol>
            </section>
                <section class="content">
                <?php
                    if(isset($_SESSION['error'])){
                    echo "
                        <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        ".$_SESSION['error']."
                        </div>
                    ";
                    unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['success'])){
                    echo "
                        <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        ".$_SESSION['success']."
                        </div>
                    ";
                    unset($_SESSION['success']);
                    }
                ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body" id="tbl">
                                    <div class="table-responsive">
                                        <table id="reportTb" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PB#/MemID</th>
                                                    <th>Last Name</th>
                                                    <th>First Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Status</th>
                                                    <th>Branch</th>
                                                    <th>Raffle Ticket</th>
                                                    <th>Date Voted</th>
                                                    <th>IP Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        
        <?php include 'includes/voters_modal.php'; ?>
        
  	    <?php include 'includes/footer.php'; ?>

        </div>
        <!-- ./wrapper -->

        <?php include 'includes/scripts.php'; ?>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
        <script>
            reloadTable()

            //ajax html table
            function reloadTable(){
                var ajax_url = "voters_fetch.php";

                $('#reportTb').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'lBfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print',
                        'excel', 'print',
                        {
                            text: 'ADD MEMBER',
                            action: function ( e, dt, node, config ) {
                                $('#newMemberModal').modal('show')
                                $('#pbno').trigger('focus');
                            }
                        }
                    ],
                    "processing": true,
                    "serverSide": true,
                    "stateSave": true,
                    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                    "ajax" : {
                        "url" : ajax_url,
                        "dataType": "json",
                        "type": "POST",
                        "data" : {
                          "action" : "fetch_members",
                        },
                        "dataSrc": "records"
                    },
                    "columns": [
                        { "data" : "counter" },
                        { "data" : "pbno" },
                        { "data" : "lastname" },
                        { "data" : "firstname" },
                        { "data" : "middlename" },
                        { "data" : "status" },
                        { "data" : "branch" },
                        { "data" : "ticket" },
                        { "data" : "voted_date" },
                        { "data" : "comp_name" },
                        { "data" : "action" }

                    ]
                });
            }

            $(document.body).on('click', 'button[name="add"], button[name="edit"]', function(e){
                var e = this;
                var frm = $(e).attr('frmTrgt')

                var isEmpty = false;

                $.each($( frm + ' input'), function(i){
                    if(!$(this).val()){
                        isEmpty = true;
                        return false;
                    } 
                })

                $.each($( frm + ' select'), function(i){
                    if(!$(this).val()){
                        isEmpty = true;
                        return false;
                    } 
                })
                
                if(!isEmpty){
                    setTimeout(function(){
                        e.disabled=true;
                        e.value='Saving...';
                    },0);
                    return true
                }
		    })

            $(document.body).on('click', '.editMember', function(e){
               $('input[name="em_id"]').val($(this).attr('memid'))
               $.ajax({
                    url: "voters_row.php",
                    method: "POST",
                    data: { id : $(this).attr('memid') },
                    dataType: "json",
                    success: function(data){
                        $('input[name="em_Lname"').val(data['lastname'])
                        $('input[name="em_Fname"').val(data['firstname'])
                        $('input[name="em_Mname"').val(data['middlename'])
                        $('input[name="em_memID"').val(data['memid'])
                        $('input[name="em_pbno"').val(data['pbnum'] ? data['pbnum'] : '-')
                        $('input[name="em_bday"').val(data['bday'])
                        $('select[name="em_status"').val(data['status'])
                        $('input[name="vDate"').val(data['voted_date'])
                    }
                });
		    })
        </script>
        <!-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> -->
    </body>
</html>