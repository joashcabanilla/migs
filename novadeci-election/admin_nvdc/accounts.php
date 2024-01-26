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
                        Accounts
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">Accounts</li>
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
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Status</th>
                                                    <th>Type</th>
                                                    <th>Account Status</th>
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
        </div>
        
        <?php include 'includes/account_modal.php'; ?>
        
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
                var ajax_url = "account_fetch.php";

                $('#reportTb').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'lBfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print',
                        'excel',
                        {
                            text: 'NEW ACCOUNT',
                            action: function ( e, dt, node, config ) {
                                $('#newAccountModal').modal('show')
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
                        { "data" : "name" },
                        { "data" : "username" },
                        { "data" : "status" },
                        { "data" : "account_status" },
                        { "data" : "account_type" },
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
                
                if(!isEmpty){
                    setTimeout(function(){
                        e.disabled=true;
                        e.value='Saving...';
                    },0);
                    return true
                }
		    })

            $(document.body).on('click', '.editAccount', function(e){
               $('input[name="a_id"]').val($(this).attr('accntID'))
               $.ajax({
                    url: "account_row.php",
                    method: "POST",
                    data: { id : $(this).attr('accntID') },
                    dataType: "json",
                    success: function(data){
                        $('input[name="efullname"').val(data['name'])
                        $('input[name="eusername"').val(data['username'])
                        $('select[name="e_account_status"').val(data['account_status'])
                        $('select[name="eType"').val(data['account_type'])
                    }
                });
		    })
        </script>
        <!-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> -->
     
    </body>
</html>