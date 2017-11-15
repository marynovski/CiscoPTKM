<?PHP

session_start();

if(isset($_POST['email']))
{
	//udana walidacja
	$wszystko_OK = true;
	
	//sprawdzenie loginu
	
	$login = $_POST['login'];

	//sprawdzenie dlugosci nicku
	
	if((strlen($login) < 3) || (strlen($login) > 15))
	{
		$wszystko_OK = false;
		$_SESSION['e_login'] = '<span style="color: red;">Nick musi posiadać od 3 do 15 znaków!</span><br /><br />';
	}
	
	//sprawdzenie czy login nie zawiera gówna
	
	if(ctype_alnum($login) == false)
	{
		$wszystko_OK = false;
		$_SESSION['e_login'] = '<span style="color: red;">Nick może składać się jedynie z liter i cyfr(bez polskich znaków)</span><br /><br />';
	}
	
	//sprawdzenie czy email nie jest upośledzony
	
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email != $emailB))
	{
		$wszystko_OK = false;
		$_SESSION['e_email'] = '<span style="color: red;">Niepoprawny adres e-mail!</span><br /><br />';
	}
	
	
	//sprawdzenie czy hasla so spoko ziomy
	
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	if((strlen($haslo1) < 8) || (strlen($haslo1) > 20))
	{
		$wszystko_OK = false;
		$_SESSION['e_haslo'] = '<span style="color: red;">Hasło musi posiadać od 8 do 20 znaków!</span><br /><br />';
	}
	
	if($haslo1 != $haslo2)
	{
		$wszystko_OK = false;
		$_SESSION['e_haslo'] = '<span style="color: red;">Hasła muszą być zgodne!</span><br /><br />';
	}
	
	$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	
	//checkbox regulaminu
	
	if(!isset($_POST['regulamin']))
	{
		$wszystko_OK = false;
		$_SESSION['e_regulamin'] = '<span style="color: red;">Musisz zaakceptować regulamin!</span><br /><br />';
	}
	
	
	//bot or not
	
	$sekret = "6LdlcScUAAAAAGoRQwLqwSWemTMil4o8eR76fjZj";
	
	$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
	
	$odpowiedz = json_decode($check);
	
	if($odpowiedz->success==false)
	{
		$wszystko_OK = false;
		$_SESSION['e_bot'] = '<span style="color: red;">We no kliknij te captchę!</span><br /><br />';
	}
	
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			//$sql2 = "SELECT * FROM users";
		
		//if($rezultat =@$polaczenie->query($sql2))
		//{
		//	$id = $rezultat->num_rows;
		//}
			//email double check
			
			$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_maili = $rezultat->num_rows;
			if($ile_maili > 0)
			{
				$wszystko_OK = false;
				$_SESSION['e_email'] = '<span style="color: red;">Istnieje już konto przypisane do tego adresu email!</span><br /><br />';
			}
			
			//login double check
			
			$rezultat = $polaczenie->query("SELECT id FROM users WHERE login='$login'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_nickow = $rezultat->num_rows;
			if($ile_nickow > 0)
			{
				$wszystko_OK = false;
				$_SESSION['e_login'] = '<span style="color: red;">Istnieje już konto o takim loginie!</span><br /><br />';
			}
			
		}
		
	}
	catch(Exception $e)
	{
		echo 'Błąd serwera :(';
	}
	
	
	
	
	
	
	
	if($wszystko_OK == true)
	{
		//JEST GIt
		$admin = "nie";
		$usun = "tak";
		//$id = $id+1;
		if($polaczenie->query("INSERT INTO users VALUES(NULL, '$login', '$haslo_hash', '$admin', '$usun', '$email')"))
		{
			$_SESSION['udane'] = '<span style="color: yellow;">Udało Ci się utworzyć konto! Możesz się zalogować!</span>';
			header('Location: index.php');
		}
		else
		{
			throw new Exception($polaczenie->error);
		}
	}
	
}

?>
<!DOCTYPE html>
<html lang="pl">

	<head>
	
		<meta charset="UTF-8" />
		<meta name="description" content="Strona dla student�w nt. konfiguracji sieci w programie Cisco Packet Tracer" />
		<meta name="keywords" content="Cisco, Packet, Tracer, student, nauka" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<title>ciscoptkm.16mb.com</title>
	
		<link href="logowaniestyle.css" rel="stylesheet" />
		<link href="style.css" rel="stylesheet" />
	
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
	</head>

	<body>
	
<!--==================================POCZ�TEK G��WNEGO POJEMNIKA========================================================================-->	
		
		<section id="container">
		
<!--==================================POCZ�TEK NAG��WKA STRONY========================================================================-->								
			<header id="header">
			
				Cisco Packet Tracer by KM
			
			</header>
			
<!--==================================KONIEC NAG��WKA STRONY==========================================================================-->



<!--==================================POCZ�TEK SEKCJI LOGOWANIA========================================================================-->

			<section id="logowanie">
			
<!--==================================POCZ�TEK FORMULARZA LOGOWANIA================================================================-->			
			
				<form method="post">
					
					Login:<br />
					<input type="text" name="login" /><br /><br />
					
					<?php
					if(isset($_SESSION['e_login']))
					{
						echo $_SESSION['e_login'];
						unset($_SESSION['e_login']);
					}
					?>
					
					Hasło:<br />
					<input type="password" name="haslo1" /><br /><br />
					
					Powtórz hasło:<br />
					<input type="password" name="haslo2" /><br /><br />
					
					<?php
					if(isset($_SESSION['e_haslo']))
					{
						echo $_SESSION['e_haslo'];
						unset($_SESSION['e_haslo']);
					}
					?>
					
					
					E-mail:<br />
					<input type="text" name="email" /><br /><br />
					
					<?php
					if(isset($_SESSION['e_email']))
					{
						echo $_SESSION['e_email'];
						unset($_SESSION['e_email']);
					}
					?>
					
					<!--Imie:<br />
					<input type="text" name="imie" /><br /><br />
					
					Nazwisko:<br />
					<input type="text" name="nazwisko" /><br /><br />
					-->
					
					
					<label>
						<input type="checkbox" name="regulamin" /> Akceptuję regulamin<br /><br />
					</label>
					
					<?php
					if(isset($_SESSION['e_regulamin']))
					{
						echo $_SESSION['e_regulamin'];
						unset($_SESSION['e_regulamin']);
					}
					?>
					
					<div class="g-recaptcha" data-sitekey="6LdlcScUAAAAAGaoml4gxTH9N9zcpxHS3SrqzENv"></div>
					
					<?php
					if(isset($_SESSION['e_bot']))
					{
						echo $_SESSION['e_bot'];
						unset($_SESSION['e_bot']);
					}
					?>
					
					<input type="submit" value="Zarejestruj" />
					
				</form>

<!--==================================KONIEC FORMULARZA LOGOWANIA==================================================================-->
				
				
				
			</section>

<!--==================================KONIEC SEKCJI LOGOWANIA==========================================================================-->
		


<!--==================================POCZ�TEK STOPKI STRONY===========================================================================-->

			<footer id="footer">
			
				ciscoptkm.16mb.com &copy; 2017
			
			</footer>
			
<!--==================================KONIEC STOPKI STRONY=============================================================================-->			
			
		</section>
		
<!--==================================KONIEC G��WNEGO POJEMNIKA==========================================================================-->		
	
	</body>
	
</html>