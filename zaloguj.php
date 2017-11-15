<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
	echo 'Error: '.$polaczenie->connect_errno;
}
else
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
	
		
	
		$sql = "SELECT * FROM users WHERE login='$login'";
		
		if($rezultat =@$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			
			
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if(password_verify($password, $wiersz['pass']))
				{
				
				
					$_SESSION['zalogowany'] = true;
					
					$_SESSION['aktualny_id'] = $wiersz['id'];
					$_SESSION['user'] = $wiersz['login'];
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['haslo'] = $wiersz['pass'];
					$_SESSION['usun'] = $wiersz['usun'];
					$_SESSION['admin'] = $wiersz['admin'];
				
				
					
					
					
					unset($_SESSION['blad']);
					$rezultat->close();
					header('Location: start.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style="color: red; text-align: center;">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				
			}
			else
			{
				$_SESSION['blad'] = '<span style="color: red; text-align: center;">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
			}
		}
		
		$polaczenie->close();
}

















?>