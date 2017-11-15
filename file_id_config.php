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

<h1>Konfiguracja pliku o nr ID = <?php echo $_POST['id']; ?> </h1>

<?php
$i = $_POST['id'];
					 require_once "connect.php";
					 
					 $polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
					 
					 if($polaczenie->connect_errno!=0)
					 {
						 echo "Error:".$polaczenie->connect_errno;
					 }
					 else
					 {
						 $sql = "SELECT * FROM pliki WHERE id=$i";
						 
						 if($rezultat =@$polaczenie->query($sql))
						 {
							 
								$ile_wierszy = $rezultat->num_rows;
							 
								$user = $rezultat->fetch_assoc();
							 
								$_SESSION['id-pliku'] = $user['id'];
								$_SESSION['nazwa'] = $user['nazwa'];
								$_SESSION['opis'] = $user['opis'];
								$_SESSION['kategoria'] = $user['kategoria'];
								$_SESSION['sciezka'] = $user['sciezka'];
								
								echo '<form method="post" action="config_file.php">';
								echo 'ID:<br /> <input size="1" type="text" name="id-pliku" value="'; echo $_SESSION['id-pliku']; echo '" " /><br /><br />';
								echo 'Nazwa:<br /> <input  type="text" name="nazwa" value="'; echo $_SESSION['nazwa'];  echo '" readonly="readonly" /><br /><br />';
								echo 'Opis:<br /> <input type="text" name="opis" value="'; echo $_SESSION['opis']; echo '"  /><br /><br />';
								echo 'Kategoria:<br /> <input type="text" name="kategoria" value="'; echo $_SESSION['kategoria']; echo '"  /><br /><br />';
								echo 'Scieżka:<br /> <input type="text" name="sciezka" value="'; echo $_SESSION['sciezka']; echo '"  /><br /><br />';
								echo '<br /> <input type="submit"" value="Zapisz zmiany" /><span style="color: red;"><br />Zmian nie można cofnąć!</span><br /><br />';
								echo '</form>';
								
								
								
									echo '<form method="post" action="usun_plik.php">';
									echo '<input type="submit" value="Usuń Plik"/>';
									echo '<input style="visibility: hidden; width: 0;" type="text" size="1" name="usun" value='; echo $_SESSION['usun'];echo' />';
									echo '<input style="visibility: hidden; width: 0;" type="text" size="1" name="id" value='; echo $_SESSION['id-pliku'];echo' />';
									echo '</form>';
								
								
								
								 
								 
							 
						 
						 }
					 }
					
					?>

<a href="files.php" title="idź sobie" class="mark" />Powrót do strony</a>

</body>

</html>