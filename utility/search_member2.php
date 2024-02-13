<?php
	require 'conn.php';

    $memberData = array();
    $memberCtr = "";
    
	if(ISSET($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM voters WHERE pbno='$search' OR memid='$search' OR lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR middlename LIKE '%$search%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $memberData = $result->fetch_all(MYSQLI_ASSOC);
            $memberCtr = count($memberData);
            $memberCtr = "found";
        }else{
            $memberCtr = "not found";
        }
    }
?>

<table class="table table-striped hide" id="updateStatusTable" data-member="<?php echo $memberCtr ?>">
    <thead class="alert-success">
        <tr>
            <th>ID</th>
            <th>PB#/MemID</th>
            <th>Name</th>
            <th>BirthDate</th>
            <th>Contact#</th>
            <th>Branch</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($memberData as $data):
        ?>
            <tr id="trStatus-<?php echo $data['id']?>">
                <td><?php echo $data['id']?></td>
                <td><?php echo !empty($fetch['pbno']) ? $data['pbno'] : $data['memid']?></td>
                <td><?php echo $data['firstname']." ". $data['middlename']." ". $data['lastname']?></td>
                <td class='bdayInfo'><?php echo $data['bday']?></td>
                <td><?php echo $data['contact_no']?></td>
                <td><?php echo $data['branch']?></td>
                <td><span class="label label-info"><?php echo $data['status']?> </span>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $data['id']?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                </td>
			</tr>
            <?php include 'update_bday.php'; ?>
        <?php
            endforeach;
        ?>
    </tbody>
</table>

<?php include 'no_record_found.php'; ?>