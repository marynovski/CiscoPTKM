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
					$id = $_POST['nr_lekcji'];
					$nr_lekcji = $_POST['nr_lekcji'];
					$opis = $_POST['opis'];
					$temat = $_POST['temat'];
					$adres_yt = $_POST['adres_yt'];

					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 $sql = "INSERT INTO lekcje VALUES ($id, '$nr_lekcji', '$temat', '$opis', '$adres_yt')";
						 
						 
						if ($polaczenie->query($sql) === TRUE) {
						echo "Record updated successfully";
						echo '<br /><a href="science.php" title="idź sobie" class="mark" />Powrót do strony</a>';

							} 
							
							else {
									echo "Error updating record: ".$polaczenie->error;
									echo '<br /><a href="science.php" title="idź sobie" class="mark" />Powrót do strony</a>';
									}	 
								
								$polaczenie->close();
								
								
								 
								 
							 
						 
						 
					 }
					
					?>

