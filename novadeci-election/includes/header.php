<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>NOVADECI VotingSystem</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="assests/icon/favicon.ico">
    <!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  	<style>
  		.mt20{
            margin-top: 20px;
          }
          .title{
            font-size: 50px;
          }
          #candidate_list{
            margin-top:20px;
          }
    
          #candidate_list ul{
            list-style-type:none;
          }
    
          #candidate_list ul li{
            margin:0 30px 30px 0;
            vertical-align:top
          }
    
          .clist{
            margin-left: 20px;
          }
    
          .cname{
            font-size: 25px;
          }
    
          .votelist{
            font-size: 17px;
          }

		.table-borderless > tbody > tr > td,
		.table-borderless > tbody > tr > th,
		.table-borderless > tfoot > tr > td,
		.table-borderless > tfoot > tr > th,
		.table-borderless > thead > tr > td,
		.table-borderless > thead > tr > th {
			border: none;
		}
  	</style>
  	<style>
    	.tixwithimg > table, .divTop { 
    		position:absolute;
    		font: normal 1.2vw/1.8 Sans-Serif;
    	}
    	@media only screen and (min-width: 1600px) {
    		.tixwithimg > table {
    			font-size: 16px !important;
          left: -5% !important;
    		}
    		.tixwithimg > .divTop {
    			font-size: 16px !important;
    		}
    	}
    	@media only screen and (min-width: 600) {
    		.tixwithimg > table {
    			font-size: 16px !important;
          left: -5% !important;
    		}
        .tixwithimg > .divTop {
    			font-size: 16px !important;
    		}
    	}
    	@media only print and (min-width: 1600px) {
    		.tixwithimg > table {
    			font-size: 30px !important;
          left:-7% !important;
          bottom: 25% !important;
    		}
        .tixwithimg > .divTop {
    			font-size: 30px !important;
    		}
        .tixNo{
          color:red !important;
        }
    	}
    	@media only print and (max-width: 600px) {
    		.tixwithimg > table {
    			font-size: 12px !important;
          left:-7% !important;
          bottom: 25% !important;
    		}
        .tixwithimg > .divTop {
    			font-size: 12px !important;
    		}
        .tixNo{
          color:red !important;
        }
    	}
    </style>
    <style media="print">
    	.dontPrint{
    		display: none !important;
    	}
    </style>
</head>
