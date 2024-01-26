<?php
	session_start();
	include 'conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE username = '$username' and account_type = 'pre-ga'";

		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect Credentials';
		}
		else{
            
			$row = $query->fetch_assoc();

            $_SESSION['error'] = isPasswordVerified($password, $row) ? (
                isActive($row) ? (isOffline($row) ? false : 'Your account is logged in on another device' ) : 'Account Blocked'
            ) : 'Incorrect Credentials';
            
            if(!$_SESSION['error']){
                getSession($row);
                $sqlUpdate = "update users set status = 'loggedIn' where user_id='".$row['user_id']."'";
		        $queryU = $conn->query($sqlUpdate);
            }
		}
       
	}

    header('location: ../');

    function isActive($row){
        return $row['account_status'] == "active" ? 
            true : false;
    }

    function isOffline($row){
        return $row['status'] == "offline" ? 
            true : false;
    }

    function isPasswordVerified($password, $row){
        return password_verify($password, $row['password']) ? 
            true : false;
    }

    function getSession($row){
        $_SESSION['frontAccountID'] = $row['user_id'];
        $_SESSION['frontAccountName'] = $row['name'];
        $_SESSION['frontAccountUsername'] = $row['username'];
        $_SESSION['frontAccountStatus'] = $row['account_status'];
        $_SESSION['frontAccountIsLogin'] = 'loggedIn';
    }

?>
