<html>
<head>
	<title>Raffle Ticket</title>
	<link rel="stylesheet" type="text/css" href="assets/print.css" />

	<link rel="stylesheet" type="text/css" href="assets/print-style.css" />
    <style type="text/css" media="print">
        /* @page { size: landscape; } */
        .dontPrint{
            display: none !important;
        }
    </style>
    <style>
        .tixwithimg > div { 
            position:absolute;
        }
    </style>

</head>
<body id="printarea">
    <div class="container">
        <div class="text-center">
            <!-- <button class="btn btn-flat btn-success btn-lg dontPrint" onclick={window.print()}>Print</button> -->
            <input type="button" value="Print" class="btn btn-outline-secondary float-right" onclick="PrintDoc()" style="margin-right: 5px"/>
            <input type="button" value="Print Preview" class="btn btn-outline-secondary float-right" onclick="PrintPreview()" style="margin-right: 5px"/>
        </div>
        <br>
        <div class="row">
            <?php 
            include 'config/db-config.php';
            global $connection;

            if(isset($_POST['toPrintPage'])) : 
                
                $branch = $_POST['branchToPrint'];
                $date = $_POST['fromTime'] == "07:00:00" && $_POST['dateToPrint'] != "All" ? 
                            date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $_POST['dateToPrint'] ) ) ) ) 
                            : $_POST['dateToPrint'];
               
                // $timeFrom = $_POST['fromTime'] != 'All' ? date('H:00:00', strtotime($_POST['fromTime']) - 60*60*8) : '';
                // $timeTo = $_POST['toTime'] != 'All' ? date('H:00:00', strtotime($_POST['toTime']) - 60*60*8) : '';
                
                $timeFrom = $_POST['fromTime'] != 'All' ? date('H:00:00', strtotime($_POST['fromTime'])) : '';
                $timeTo = $_POST['toTime'] != 'All' ? date('H:00:00', strtotime($_POST['toTime'])) : '';
                
                $branch = !empty($branch) && $branch != "All" ? "AND branch = '". $branch ."' " : '';
                $date = !empty($date) && $date != "All" ? "AND DATE(voted_date) = '". $date ."' " : '';
                $timeFrom = !empty($timeFrom) && $timeFrom != "All" ? "AND TIME(voted_date + INTERVAL 8 HOUR) >= '". $timeFrom ."' " : '';
                $timeTo = !empty($timeTo) && $timeTo != "All" ? "AND TIME(voted_date + INTERVAL 8 HOUR) <= '". $timeTo ."' " : '';
                
                $sql = "SELECT id, pbno, lastname, firstname, middlename, ticket from voters WHERE isregistered='1' " . $branch . $date . $timeFrom . $timeTo . 'order by voted_date';
                $query = $connection->query($sql);
                while ($row = $query->fetch_assoc()) :
                    $name = substr($row['lastname'] .', '. $row['firstname'], 0, 30);
                ?>
                        <div class="col-sm-4">
                            <div style="position: relative; border: 1px dashed" class="text-center tixwithimg">
                                <img src="assets/raffle_tix.jpg" alt="tix" style="width: 310px">
                                <div class="divTop" style="position: absolute; top: 5%; right: 10%; font-weight: bold; color:red">
                                    <?= $row['ticket'] ?>
                                </div>
                                <div class="divPb" style="position: absolute; top: 20%; left: 50%;">
                                    <?= $row['pbno'] ?>
                                </div>
                                <div class="divName" style="position: absolute; top: 38%; left: 20%;">
                                    <?= 
                                        strlen($name) >= 30 ? $name . '...' : $name;
                                    ?>
                                </div>
                            </div>
                        </div>

                <?php endwhile ?>

            <?php else : header("location: report.php"); endif ?>
        </div>
    </div>

    <script>
        /*--This JavaScript method for Print command--*/

    function PrintDoc() {

    var toPrint = document.getElementById('printarea');

    var popupWin = window.open('', '_blank', 'width=1050,height=850,location=no');

    popupWin.document.open();

    popupWin.document.write('<html><title>Raffle Ticket</title><link rel="stylesheet" type="text/css" href="assets/print.css" /></head><body onload="window.print()">')

    popupWin.document.write(toPrint.innerHTML);

    popupWin.document.write('</html>');

    popupWin.document.close();

    }

    /*--This JavaScript method for Print Preview command--*/

    function PrintPreview() {

    var toPrint = document.getElementById('printarea');

    var popupWin = window.open('', '_blank', 'width=1050,height=850,location=no');

    popupWin.document.open();

    popupWin.document.write('<html><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="assets/print.css" media="screen"/></head><body">')

    popupWin.document.write(toPrint.innerHTML);

    popupWin.document.write('</html>');

    popupWin.document.close();

    }
    </script>

</body>
</html>