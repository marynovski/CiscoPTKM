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
					$id = $_POST['id-pliku'];
					$nr_lekcji = $_POST['nazwa'];
					$opis = $_POST['opis'];
					$temat = $_POST['kategoria'];
					$adres_yt = $_POST['sciezka'];

					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 $sql = "UPDATE lekcje SET nr_lekcji='$nr_lekcji', opis='$opis', temat='$temat', adres_yt='$adres_yt' WHERE id='$id'";
						 
						 
						if ($polaczenie->query($sql) === TRUE) {
						echo "Record updated successfully";
						echo '<br /><a href="files.php" title="idź sobie" class="mark" />Powrót do strony</a>';

							} 
							
							else {
									echo "Error updating record: " . $conn->error;
									echo '<br /><a href="files.php" title="idź sobie" class="mark" />Powrót do strony</a>';
									}	 
								
								$polaczenie->close();
								
								
								 
								 
							 
						 
						 
					 }
					
					?>

