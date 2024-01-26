<?php
include 'config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_members'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $columns = ' user_id, name, username, status, account_status, account_type';
    $table = ' users';

    $columns_order = array(
        0 => 'user_id',
        1 => 'name',
        2 => 'username',
        3 => 'status',
        4 => 'account_status',
        5 => 'account_type'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ";

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
      $sql.="where ( name LIKE '%".$requestData['search']['value']."%' ";
      $sql.=" OR username LIKE '%".$requestData['search']['value']."%' )";
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
        $nestedData['id'] = $row["user_id"];
        $nestedData['name'] = $row["name"];
        $nestedData['username'] = $row["username"];
        $nestedData['status'] = $row["status"];
        $nestedData['account_status'] = $row["account_status"];
        $nestedData['account_type'] = $row["account_type"];
        $nestedData['action'] = '<button class="btn btn-sm btn-primary editAccount" accntID="'.$row['user_id'].'" data-target="#editAccountForm" data-toggle="modal">Edit</button>';
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
