<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
	<?php
	$form ="<h3>Create a User</h3>
                    
    <form action='create-user.php' method='post'>
		<table>
        	<tr> 
	  			<td>Username</td>
                <td><input name='username' type='text'  placeholder='Username' required></td>
			</tr>
			<tr>                   
   				<td>Password</td>
            	<td><input name='password' type='password' placeholder='Password' required></td>
            </tr>
			<tr>    
                <td>Is Admin?</td>
                <td><input name='isadmin' type='checkbox'  placeholder='Is Admin' value='1'></td>
            </tr>
			<tr>
				<td><input  type='submit' name='create_user' value='Create'/></td>
                <td><a class='btn' href='../user.php'>Back</a></td>
			</tr>
		</table>

    </form>";

		if($_POST['create_user']){
			$username = $_POST['username'];
			$password = $_POST['password'];	
			$isadmin = ($_POST['isadmin'])? 1 : 0;
			$password = md5($password);			
		
			include('../connect.php');
		
			$newIdSql = "SELECT count(id) as total from users";
			$result = $conn->query($newIdSql);
			$id = mysqli_fetch_array($result)['total'];
			$id++;
			
			if(!mysqli_query($conn, "INSERT INTO users VALUES ('{$id}','{$username}','{$password}','{$isadmin}')")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "Successfully created a user! <br> $form";
			}	
		
			mysqli_close($conn);
			
			
		
		}
		else{
			echo "$form";
		}
		
	?>



</body>
</html>
        