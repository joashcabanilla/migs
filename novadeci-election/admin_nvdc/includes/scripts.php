<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- ChartJS Horizontal Bar -->
<script src="../bower_components/chart.js/Chart.HorizontalBar.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Active Script -->
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;

	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!-- Date and Timepicker -->
<script>
$(function(){
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  }) 
});

function getSequence(key) {
  $.ajax({
    type: 'GET',
    url: 'sequence_get.php',
    data: {key:key},
    success: function(data){
      data = JSON.parse(data)
      $('input[name="seqPrefix"]').val(data.prefix)
      $('input[name="seqNo"]').val(data.sequence_no)
      $('input[name="seqLength"]').val(data.sequence_length)
      $('input[name="seqFill"]').val(data.no_fill)
      SettingOutput()
      $('input[name="url"]').val(window.location)
    }
  })
}

$('input[name="seqPrefix"]').on('keyup', function(){
    SettingOutput()
})
$('input[name="seqNo"]').on('keyup', function(){
    SettingOutput()
})
$('input[name="seqLength"]').on('keyup', function(){
    SettingOutput()
})
$('input[name="seqFill"]').on('keyup', function(){
    SettingOutput()
})

const SettingOutput = () => {
    var setPrefix = $('input[name="seqPrefix"]').val()
    var setNum = $('input[name="seqNo"]').val()
    var setNumLength = $('input[name="seqLength"]').val()
    var setFillNum = $('input[name="seqFill"]').val()
    var output = setPrefix + setNum.padStart(setNumLength, setFillNum)

    $('input[name="seqOutput"]').val(output)
}
</script>


