<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php
  	if($_SESSION['admin'] == 2){
        header('location:report.php');
    }
  ?>
  
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>No. of Positions</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM candidates";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>No. of Candidates</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM voters";
                $query = $conn->query($sql);
                $v = $query->num_rows;
                $voters = number_format($v);
                echo "<h3>".$voters."</h3>";
              ?>

              <p>Total Records</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * from voters where isregistered = 1";
                $query = $conn->query($sql);
                $qv = $query->num_rows;
                // $qv = "10799";
                $voted = number_format($qv);
                echo "<h3>".$voted."</h3>";
              ?>

              <p>Voted Voters</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-purple">
            <div class="inner">
            <?php
                $sql = "SELECT * FROM voters WHERE status='MIGS'";
                $query = $conn->query($sql);
                $v = $query->num_rows;
                $voters = number_format($v);
                echo "<h3>".$voters."</h3>";
              ?>
                <!--<h3>16,484</h3>-->
              <p>Total MIGS</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">

              <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                $query = $conn->query($sql);
                $q1 = $query->num_rows;
                $migs = 16484;
                $total = (($q1/$migs)* 100);
                $quorum = number_format($total, 2);
                echo "<h3>".$quorum."&nbsp;%</h3>";
              ?>
              <p>Quorum</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
              <h4><b>Caloocan & Bulacan</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="#" class="small-box-footer">
            <?php
              $sql = "SELECT * FROM voters WHERE branch='BSILANG OFFICE' AND isregistered='1'";
              $query = $conn->query($sql);
              $bs_voters = $query->num_rows;
            //   $bs_voters = number_format($v);
              echo "<h5>"."BSilang &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$bs_voters."</h5>";
            ?>
            <?php
              $sql = "SELECT * FROM voters WHERE branch='CAMARIN OFFICE' AND isregistered='1'";
              $query = $conn->query($sql);
              $c_voters = $query->num_rows;
            //   $c_voters = number_format($v);
              echo "<h5>"."Camarin &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$c_voters."</h5>";
            ?>
            <?php
              $sql = "SELECT * FROM voters WHERE branch='KIKO OFFICE' AND isregistered='1'";
              $query = $conn->query($sql);
              $k_voters = $query->num_rows;
            //   $k_voters = number_format($v);
              echo "<h5>"."Kiko &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$k_voters."</h5>";
            ?>
            <?php
              $sql = "SELECT * FROM voters WHERE branch='BULACAN OFFICE' AND isregistered='1'";
              $query = $conn->query($sql);
              $bul_voters = $query->num_rows;
            //   $k_voters = number_format($v);
              echo "<h5>"."Bulacan &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$bul_voters."</h5>";
            ?>
            <?php
              $total_voters = number_format($bs_voters + $c_voters + $k_voters + $bul_voters);
              echo "<h4 style='text-align:left;margin-left:10px;'>"."Total: &nbsp;<b>".$total_voters."</h4>";
            ?>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
              <h4><b>Quezon City</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="#" class="small-box-footer">
              <?php
                $sql = "SELECT * FROM voters WHERE branch='MAIN OFFICE' AND isregistered='1'";
                $query = $conn->query($sql);
                $m_voters = $query->num_rows;
                // $m_voters = number_format($v);
                echo "<h5>"."Main Office &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$m_voters."</h5>";
              ?>
              <?php
                $sql = "SELECT * FROM voters WHERE branch='FAIRVIEW OFFICE' AND isregistered='1'";
                $query = $conn->query($sql);
                $f_voters = $query->num_rows;
                // $f_voters = number_format($v);
                echo "<h5>"."Fairview &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$f_voters."</h5>";
              ?>
              <?php
                $sql = "SELECT * FROM voters WHERE branch='LAGRO OFFICE' AND isregistered='1'";
                $query = $conn->query($sql);
                $l_voters = $query->num_rows;
                // $l_voters = number_format($v);
                echo "<h5>"."Lagro &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$l_voters."</h5>";
              ?>
              <?php
                $sql = "SELECT * FROM voters WHERE branch='MUNOZ OFFICE' AND isregistered='1'";
                $query = $conn->query($sql);
                $mun_voters = $query->num_rows;
                // $mun_voters = number_format($v);
                echo "<h5>"."Muñoz &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$mun_voters."</h5>";
              ?>
              <?php
                $sql = "SELECT * FROM voters WHERE branch='TSORA OFFICE' AND isregistered='1'";
                $query = $conn->query($sql);
                $ts_voters = $query->num_rows;
                // $ts_voters = number_format($v);
                echo "<h5>"."TSora &nbsp;<i class='fa fa-arrow-circle-right'></i> &nbsp;".$ts_voters."</h5>";
              ?>
              <?php
                $total_voters = number_format($m_voters + $ts_voters + $mun_voters + $l_voters + $f_voters);
                echo "<h4 style='text-align:left;margin-left:10px;'>"."Total: &nbsp;<b>".$total_voters."</h4>";
              ?>
            </a>
          </div>
        </div>



      </div>

      <div class="row">
        <div class="col-xs-12">
          <h3>Votes Tally
            <span class="pull-right">
              <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </span>
          </h3>
        </div>
      </div>

      <?php
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);
        $inc = 2;
        while($row = $query->fetch_assoc()){
          $inc = ($inc == 2) ? 1 : $inc+1;
          if($inc == 1) echo "<div class='row'>";
          echo "
            <div class='col-sm-6'>
              <div class='box box-solid'>
                <div class='box-header with-border'>
                  <h4 class='box-title'><b>".$row['description']."</b></h4>
                </div>
                <div class='box-body'>
                  <div class='chart'>
                    <canvas id='".slugify($row['description'])."' style='height:200px'></canvas>
                  </div>
                </div>
              </div>
            </div>
          ";
          if($inc == 2) echo "</div>";
        }
        if($inc == 1) echo "<div class='col-sm-6'></div></div>";
      ?>

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<?php
  $sql = "SELECT * FROM positions ORDER BY priority ASC";
  $query = $conn->query($sql);
  while($row = $query->fetch_assoc()){
    $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while($crow = $cquery->fetch_assoc()){
      array_push($carray, $crow['lastname']);
      $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
      $vquery = $conn->query($sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
    ?>
    <script>
    $(function(){
      var rowid = '<?php echo $row['id']; ?>';
      var description = '<?php echo slugify($row['description']); ?>';
      var barChartCanvas = $('#'+description).get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      var barChartData = {
        labels  : <?php echo $carray; ?>,
        datasets: [
          {
            label               : 'Votes',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : <?php echo $varray; ?>
          }
        ]
      }
      var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }

      barChartOptions.datasetFill = false
      var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
      //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
    });
    </script>
    <?php
  }
?>

<script>
  setTimeout(function(){
    window.location.reload(1);
  }, 10000);
</script>
</body>
</html>
