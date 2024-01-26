<?php 

    include 'includes/session.php';

    if(isset($_GET['key']) == "getSequence"){
    
        $row = hasSequence($conn);
        
        if(empty($row)){
            $sql = "INSERT INTO raffle_sequence (prefix, sequence_no, no_fill, sequence_length) VALUES ('O', '1', '0', '7')";
            $conn->query($sql);
        } 
        
        echo json_encode( hasSequence($conn) );
    }

    function hasSequence($conn){
        $sql = "SELECT * from raffle_sequence";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
?>