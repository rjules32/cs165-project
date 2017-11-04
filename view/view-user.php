<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
   <?php
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: ../user.php");
		}else{
			include("../connect.php");
			
			$sql = "SELECT * from users WHERE id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$username = $row['username'];
			$password = $row['password'];
			$isadmin = ($row['is_admin'] == '1')? 'Yes': 'No';
		}
   
   
		$form="<h3>View a User</h3>
			<table border='1'>
        	<tr> 
	  			<td>Username</td>
                <td>".$username."</td>
			</tr>
			<tr>                   
   				<td>Password</td>
            	<td>".$password."</td>
            </tr>
			<tr>    
                <td>Is Admin?</td>
                <td>".$isadmin."</td>
            </tr>
		</table><br/><a class='btn' href='../user.php'>Back</a";
		
		echo "$form";
		
		
		mysqli_close($conn);
		
	?>
  </body>
</html>