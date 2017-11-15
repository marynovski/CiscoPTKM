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

<!DOCTYPE html>
<html lang="pl">

<head>

		<meta charset="UTF-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		
		<link href="style.css" rel="stylesheet" />
		<link href="fontello/css/fontello.css" rel="stylesheet" />
		<link href="kafelkistyle.css" rel="stylesheet" />
		
		<title>Cisco Packet Tracer by KM</title>
		
		<style>
		
		.mark:hover
		{
			transition-duration: 1s;
			color: green;
		}
				
		</style>
		
		
</head>

<body>

<h1>Dodawanie nowego pliku </h1>

<?php
					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 
						 
						 
							 
								
							 
								
								
								echo '<form method="post" action="add_lesson.php">';
								echo 'Nr:<br /> <input  type="text" name="nr_lekcji" /><br /><br />';
								echo 'Opis:<br /> <input type="text" name="opis" /><br /><br />';
								echo 'Temat:<br /> <input type="text" name="temat" /><br /><br />';
								echo 'Adres YT:<br /> <input type="text" name="adres_yt"  /><br /><br />';
								echo '<br /> <input type="submit"" value="Dodaj" /><span style="color: red;"><br />Zmian nie można cofnąć!</span><br /><br />';
								echo '</form>';
								
								
								
									
								
								
								
								 
								 
							 
						 
						 }
						 $polaczenie->close();
					 
					
					?>

<a href="files.php" title="idź sobie" class="mark" />Powrót do strony</a>

</body>

</html>