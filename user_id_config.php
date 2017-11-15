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

<h1>Konfiguracja użytkownika o nr ID = <?php echo $_POST['id']; ?> </h1>

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
						 $sql = "SELECT * FROM users WHERE id=$i";
						 
						 if($rezultat =@$polaczenie->query($sql))
						 {
							 
								$ile_wierszy = $rezultat->num_rows;
							 
								$user = $rezultat->fetch_assoc();
							 
								$_SESSION['id'] = $user['id'];
								$_SESSION['nick'] = $user['login'];
								$_SESSION['pass'] = $user['pass'];
								$_SESSION['czy_admin'] = $user['admin'];
								$_SESSION['email'] = $user['email'];
								$_SESSION['usun'] = $user['usun'];
								
								echo '<form method="post" action="config_user.php">';
								echo 'ID:<br /> <input size="1" type="text" name="id" value="'; echo $_SESSION['id']; echo '" " /><br /><br />';
								echo 'Nick:<br /> <input  type="text" name="nick" value="'; echo $_SESSION['nick']; echo '" readonly="readonly" /><br /><br />';
								echo 'E-mail:<br /> <input type="text" name="email" value="'; echo $_SESSION['email']; echo '"  /><br /><br />';
								echo 'Admin:<br /> <input type="text" name="admin" value="'; echo $_SESSION['czy_admin']; echo '"  /><br /><br />';
								echo '<br /> <input type="submit"" value="Zapisz zmiany" /><span style="color: red;"><br />Zmian nie można cofnąć!</span><br /><br />';
								echo '</form>';
								
								
								if($_SESSION['usun'] == "tak")
								{
									echo '<form method="post" action="usun.php">';
									echo '<input type="submit" value="Usuń Użytkownika"/>';
									echo '<input style="visibility: hidden; width: 0;" type="text" size="1" name="usun" value='; echo $_SESSION['usun'];echo' />';
									echo '<input style="visibility: hidden; width: 0;" type="text" size="1" name="id" value='; echo $_SESSION['id'];echo' />';
									echo '</form>';
								}
								
								
								 
								 
							 
						 
						 }
					 }
					
					?>

<a href="users.php" title="idź sobie" class="mark" />Powrót do strony</a>

</body>

</html>