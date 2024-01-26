<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php  include "config/db-config.php";?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <?php
  	if($_SESSION['admin'] == 2){
        header('location:report.php');
    }
  ?>
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
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>PB#/MemID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Status</th>
                    <th>Branch</th>
                    <th>Registered Date</th>
                    <th>Date Voted</th>
                    <th>IP Address</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="assets/jquery-3.5.1.min.js"></script>
  <script src="assets/jquery.dataTables-1.10.20.min.js"></script>
  <script src="assets/buttons.print-2.2.2.min.js"></script>
  <script src="assets/dataTables.bootstrap-1.10.20.min.js"></script>
  <script type="text/javascript">
      load_data();

      function load_data(initial_date, final_date, user_s){
        var ajax_url = "jquery-ajax.php";

        $('#fetch_generated_wills').DataTable({
          "order": [[ 0, "desc" ]],
          dom: 'Blfrtip',
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
              "initial_date" : initial_date,
              "final_date" : final_date,
              "user_s" : user_s
            },
            "dataSrc": "records"
          },
          "columns": [
            { "data" : "counter" },
            { "data" : "voters_id" },
            { "data" : "lastname" },
            { "data" : "firstname" },
            { "data" : "middlename" },
            { "data" : "status" },
            { "data" : "branch" },
            { "data" : "regs_date" },
            { "data" : "voted_date" },
            { "data" : "comp_name" }

          ]
        });
      }

      $("#filter").click(function(){
        var initial_date = $("#initial_date").val();
        var final_date = $("#final_date").val();
        var user_s = $("#user_s").val();

        if(initial_date == '' && final_date == ''){
          $('#fetch_generated_wills').DataTable().destroy();
          load_data("", "", user_s); // filter immortalize only
        }else{
          var date1 = new Date(initial_date);
          var date2 = new Date(final_date);
          var diffTime = Math.abs(date2 - date1);
          var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

          if(initial_date == '' || final_date == ''){
              $("#error_log").html("Warning: You must select both (start and end) date.</span>");
          }else{
            if(date1 > date2){
                $("#error_log").html("Warning: End date should be greater then start date.");
            }else{
               $("#error_log").html("");
               $('#fetch_generated_wills').DataTable().destroy();
               load_data(initial_date, final_date, user_s);
            }
          }
        }
      });
    </script>
  <?php include 'includes/footer.php'; ?>
</div>

</body>
</html>
