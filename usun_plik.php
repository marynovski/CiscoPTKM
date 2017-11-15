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
					$usun = $_POST['usun'];
					$id = $_POST['id'];
					

					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 $sql = "DELETE FROM pliki WHERE id='$id'";
						 
						 
						if ($polaczenie->query($sql) === TRUE) {
							header('Location: files.php');
							exit();
						}
						else
						{
							header('Location: files.php');
							exit();
						}
						
						$polaczenie->close();
								
								
								 
								 
							 
						 
						 
					 }
					
					?>