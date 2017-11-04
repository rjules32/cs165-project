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
		function generateForm($id, $curr_username, $curr_password, $curr_isadmin){
			$curr_isadmin = ($curr_isadmin)? 'checked': null;
			return "<h3>Edit a User</h3>
		<form action = 'edit-user.php?id=$id' method='post'>
		<table>
        	<tr> 
	  			<td>Username</td>
                <td><input name='new_username' type='text'  value='".$curr_username."' required></td>
			</tr>
			<tr>                   
   				<td>Password</td>
            	<td><input name='new_password' type='password' value='".$curr_password."' required></td>
            </tr>
			<tr>    
                <td>Is Admin?</td>
                <td><input name='new_isadmin' type='checkbox' value='1' $curr_isadmin></td>
            </tr>
			<tr>
				<td><input  type='submit' name='edit_user' value='Save'/></td>
                <td><a class='btn' href='../user.php'>Back</a></td>
			</tr>
		</table> </form>";
		}
   
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
			$curr_username = $row['username'];
			$curr_password = $row['password'];
			$curr_isadmin = ($row['is_admin'])? 'checked' : null;
		
			mysqli_close($conn);
		}
   
		if($_POST['edit_user']){
			$new_username = $_POST['new_username'];
			$new_password = $_POST['new_password'];	
			$new_isadmin = ($_POST['new_isadmin'])? 1 : 0;
		
			include('../connect.php');
		
			if(!mysqli_query($conn, "UPDATE users SET username = '{$new_username}' 
					, password = '{$new_password}'
					, is_admin = '{$new_isadmin}' 
					WHERE id = '{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($id, $new_username, $new_password, $new_isadmin);
			} else { 
				echo "Successfully edited a user! <br/>". generateForm($id, $new_username, $new_password, $new_isadmin);
			}
		
			mysqli_close($conn);
		} else{
			echo generateForm($id, $curr_username, $curr_password, $curr_isadmin);
		}
		
			
		
	?>
  </body>
</html>