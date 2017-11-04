<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
<title>Generate User Tables</title>
</head>

<body>

	<?php	
		$form="<div>
			<p> <a href='create/create-user.php' class='btn btn-success'>Create</a><p>
			<form action='user.php' method='post'>
				<input type='checkbox' name='check_list[]' value='id'>ID</input>		
				<input type='checkbox' name='check_list[]' value='username'>Username</input>			
				<input type='checkbox' name='check_list[]' value='password'>Password</input>	
				<input type='checkbox' name='check_list[]' value='is_admin'>Is Admin</input>	
				
				<input type='submit' name='generate' value='Generate'/>
				
			</form>
		</div>";
			$cols = "1";
		
		if($_POST['generate']){
			echo "$form</br>";
			$arrCheckBox = $_POST['check_list'];
			if($arrCheckBox){
			
				echo "<table border='1'><tr><th>action</th>";
				foreach($arrCheckBox as $check) {
					$cols = "$cols,$check"; 
					echo "<th>$check</th>";
				}
				echo "</tr>";
				
				include('connect.php');
				$sql = "SELECT * from users";
				
				$result = $conn->query($sql);
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo '<td><a href="edit/edit-user.php?id='.$row['id'].'">edit</a>
					| <a href="view/view-user.php?id='.$row['id'].'">view</a>
					| <a href="delete/delete-user.php?id='.$row['id'].'">delete</a></td>';
					foreach($_POST['check_list'] as $rowVal){
						echo "<td>" . $row[$rowVal] . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";		
				
				mysqli_close($conn);
			}

			
			
			
			
			
			
		//	require("connect.php");
		
		//	$query = mysql_query("SELECT * from users;");
				
		} else {
			echo "$form";
		}
		
		
	
	?>



</body>

</html>

