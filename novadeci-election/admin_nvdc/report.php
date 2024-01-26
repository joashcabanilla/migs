<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<?php  include "config/db-config.php";?>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
<?php
  	//if($_SESSION['admin'] == 1){
       //header('location:home.php');
    //}
?>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">

            <?php include 'includes/navbar.php'; ?>
            <?php include 'includes/menubar.php'; ?>

            <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Votes
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Votes</li>
                </ol>
            </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body" id="tbl">
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-4">
                                            <label>Branch</label>
                                            <select name="memberBranch" class="form-control selectElement">
                                                <option>All</option>
                                                <?php 
                                                            $sql = "SELECT distinct(branch) as branch from voters WHERE isregistered='1'";
                                                            $query = $connection->query($sql);
                                                            while($row = $query->fetch_assoc()):?>
                                                <option value="<?= $row['branch'] ?>"><?= $row['branch'] ?></option>
                                                <?php endwhile?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Date Voted</label>
                                            <select name="dateVoted" class="form-control selectElement">
                                                <option>All</option>
                                                <?php 
                                                            $sql = "SELECT distinct cast(voted_date + INTERVAL 8 HOUR as date) as voted_date from voters WHERE isregistered='1'";
                                                            $query = $connection->query($sql);
                                                            while($row = $query->fetch_assoc()):?>
                                                <option value="<?= $row['voted_date'] ?>"><?= $row['voted_date'] ?></option>
                                                <?php endwhile?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 pull-right">
                                            <label></label><br>
                                            <button class="btn btn-primary pull-right" data-target="#reportWithTicketModal" data-toggle="modal"
                                                id="customPrintBtn">Print Ticket</button>
                                        </div>
                                    </div>
                                    <br>
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
            function reloadTable(branch, dateVoted){
                var ajax_url = "report_fetch.php";

                $('#reportTb').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
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
                        "branch" : branch,
                        "dateVoted" : dateVoted,
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
                        { "data" : "comp_name" }

                    ]
                });
            }

            $(document.body).on('change', '.selectElement', function(){
                dropChange()
            })

            const dropChange = () => {
                var memberBranch = $('select[name="memberBranch"]').val()
                var dateVoted = $('select[name="dateVoted"]').val()


                memberBranch = memberBranch == 'All' ? '' : memberBranch
                dateVoted = dateVoted == 'All' ? '' : dateVoted
                $('#reportTb').DataTable().destroy();
                
                reloadTable(memberBranch, dateVoted)
            }

            const drawTable = (col,val) => {
                return val != "All" ?
                    table.columns(col).search(val).draw()
                    : table.columns(col).search('').draw()
            }

            $(document.body).on('click', '#customPrintBtn', function(){
                $('select[name="branchToPrint"]').empty().append( $('select[name="memberBranch"] option').clone() )
                $('select[name="dateToPrint"]').empty().append( $('select[name="dateVoted"] option').clone() )
            })

            $('button[name="toPrintPage"]').on('click', function(){
                $('#reportWithTicketModal').modal('hide');
            })
        </script>
        <!-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> -->
    </body>
</html>