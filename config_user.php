<?php

session_start();

if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
{
	header('Location: index.php');
	exit();
}
else
{
	if($_SESSION['admin'] == 'nie')
	{
		header('Location: start.php');
		exit();
	}
}
?>



<?php
					$id = $_POST['id'];
					$email = $_POST['email'];
					$admin = $_POST['admin'];

					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 $sql = "UPDATE users SET email='$email', admin='$admin' WHERE id='$id'";
						 
						 
						if ($polaczenie->query($sql) === TRUE) {
						echo "Record updated successfully";
						echo '<br /><a href="users.php" title="idź sobie" class="mark" />Powrót do strony</a>';

							} 
							
							else {
									echo "Error updating record: " . $conn->error;
									echo '<br /><a href="users.php" title="idź sobie" class="mark" />Powrót do strony</a>';
									}	 
								
								$polaczenie->close();
								
								
								 
								 
							 
						 
						 
					 }
					
					?>

