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
			
			mysqli_close($conn);
		}
   
   
		$form="<h3>Delete a User</h3>
			<p class='alert alert-error'>Are you sure you want to delete this user?</p>
			<form action = 'delete-user.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_user' type='submit' value='Yes'/></td>
                <td><a class='btn' href='../user.php'>No</a></td>
			</tr>
		</table>
		<br/><br/>
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
		</table>
		</form>
		
		";
		
		if($_POST['delete_user']){		
			include('../connect.php');
		
			if(!mysqli_query($conn, "DELETE FROM users WHERE id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else { 
				echo "Successfully deleted a user! <br/> <a class='btn' href='../user.php'>Back</a> ";
			}
		
			mysqli_close($conn);
		} else{
			echo  "$form";
		}
		
		
		
	?>
  </body>
</html>