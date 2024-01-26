<?php
include 'config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_members'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $branch = $_REQUEST['branch'];
    $dateVoted = $_REQUEST['dateVoted'];


    $branch = !empty($branch) ? "AND branch = '". $branch ."' " : '';
    $dateVoted = !empty($dateVoted) ? "AND DATE(voted_date + INTERVAL 8 HOUR) = '". $dateVoted ."' " : '';


    $columns = ' id, pbno, lastname, firstname, middlename, status, branch, ticket, voted_date, comp_name';
    $table = ' voters ';
    $where = " WHERE isregistered='1' ".$branch.$dateVoted;

    $columns_order = array(
        0 => 'id',
        1 => 'pbno',
        2 => 'lastname',
        3 => 'firstname',
        4 => 'middlename',
        5 => 'status',
        6 => 'branch',
        7 => 'ticket',
        8 => 'voted_date',
        9 => 'comp_name'

    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
      $sql.=" AND ( pbno LIKE '%".$requestData['search']['value']."%' ";
      $sql.=" OR CONCAT( lastname,  ' ', firstname,  ' ', middlename ) like '%".$requestData['search']['value']."%'";
      $sql.=" OR branch LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR voted_date + INTERVAL 8 HOUR LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR branch LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pbno'] = $row["pbno"];
        $nestedData['lastname'] = $row["lastname"];
        $nestedData['firstname'] = $row["firstname"];
        $nestedData['middlename'] = $row["middlename"];
        $nestedData['status'] = $row["status"];
        $nestedData['branch'] = $row["branch"];
        $nestedData['ticket'] = $row["ticket"];
        $time = strtotime($row["voted_date"]) + 60*60*8;
        $nestedData['voted_date'] = date('d M, Y - H:i:s', $time);
        $nestedData['comp_name'] = $row["comp_name"];

        // $nestedData['email'] = '<a href="mailto:'.strtolower($row["email"]).'">'.strtolower($row["email"]).'</a>';
        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>
