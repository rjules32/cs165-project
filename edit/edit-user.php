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
			$isadmin = $row['is_admin'];
		}
   
   
		$form="<h3>Edit a User</h3>
		<table>
        	<tr> 
	  			<td>Username</td>
                <td><input name='username' type='text'  placeholder='".$username." required></td>
			</tr>
			<tr>                   
   				<td>Password</td>
            	<td><input name='password' type='password' placeholder='".$password."' required></td>
            </tr>
			<tr>    
                <td>Is Admin?</td>
                <td><input name='isadmin' type='checkbox'  placeholder='".$isadmin."' value='1'></td>
            </tr>
			<tr>
				<td><input  type='submit' name='create_user' value='Create'/></td>
                <td><a class='btn' href='../user.php'>Back</a></td>
			</tr>
		</table>
		
		echo "$form";
		
		mysqli_close($conn);
		
	?>
  </body>
</html>