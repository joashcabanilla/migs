<?php
include 'config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_members'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $user_s = $_REQUEST['user_s'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND forum_day BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($user_s != ''){
        $user_s = " AND user_s = '$user_s' ";
    }

    $columns = ' id, voters_id, lastname, firstname, middlename, status, branch, regs_date, voted_date, comp_name';
    $table = ' voters ';
    $where = " WHERE isregistered='1' ".$date_range.$isregistered;

    $columns_order = array(
        0 => 'id',
        1 => 'voters_id',
        2 => 'lastname',
        3 => 'firstname',
        4 => 'middlename',
        5 => 'status',
        6 => 'branch',
        7 => 'regs_date',
        8 => 'voted_date',
        9 => 'comp_name'

    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
      $sql.=" AND ( voters_id LIKE '%".$requestData['search']['value']."%' ";
      $sql.=" OR CONCAT( lastname,  ' ', firstname,  ' ', middlename ) like '%".$requestData['search']['value']."%'";
      $sql.=" OR branch LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR voted_date LIKE '%".$requestData['search']['value']."%'";
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
        $nestedData['voters_id'] = $row["voters_id"];
        $nestedData['lastname'] = $row["lastname"];
        $nestedData['firstname'] = $row["firstname"];
        $nestedData['middlename'] = $row["middlename"];
        $nestedData['status'] = $row["status"];
        $nestedData['branch'] = $row["branch"];
        $time2 = strtotime($row["regs_date"]);
        $nestedData['regs_date'] = date('d M, Y - h:i:s', $time2);
        $time = strtotime($row["voted_date"]);
        $nestedData['voted_date'] = date('d M, Y - h:i:s', $time);
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
