<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: start.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl">

	<head>
	
		<meta charset="UTF-8" />
		<meta name="description" content="Strona dla studentów nt. konfiguracji sieci w programie Cisco Packet Tracer" />
		<meta name="keywords" content="Cisco, Packet, Tracer, student, nauka" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<title>ciscoptkm.16mb.com</title>
	
		<link href="logowaniestyle.css" rel="stylesheet" />
		<link href="style.css" rel="stylesheet" />
	
	</head>

	<body>
	
<!--==================================POCZĄTEK GŁÓWNEGO POJEMNIKA========================================================================-->	
		
		<section id="container">
		
<!--==================================POCZĄTEK NAGŁÓWKA STRONY========================================================================-->								
			<header id="header">
			
				Cisco Packet Tracer by KM
			
			</header>
			
<!--==================================KONIEC NAGŁÓWKA STRONY==========================================================================-->



<!--==================================POCZĄTEK SEKCJI LOGOWANIA========================================================================-->

			<section id="logowanie">
			
<!--==================================POCZĄTEK FORMULARZA LOGOWANIA================================================================-->			
			
				<form method="post" action="zaloguj.php" id="logowanie-formularz">
					
					Login: <br />
					<input type="text" name="login" />
					
					<br /><br />

					Hasło: <br />
					<input type="password" name="password" />
					
					<br />
					
					<input type="submit" value="Zaloguj się" />
					
					<br /><br />
					
					<a href="forgot.php" title="Przypomnimy Ci!" class="mark">Zapomniałeś hasła?</a>
					
					<br />
					
					<a href="rejestracja.php" title="Załóż je!" class="mark">Nie masz konta?</a>
					
					<?php
				
					if(isset($_SESSION['blad']))
					{
						echo $_SESSION['blad'];
						unset($_SESSION['blad']);
					}
					
					?>
					<br />
					<?php
				
					if(isset($_SESSION['udane']))
					{
						echo $_SESSION['udane'];
						unset($_SESSION['udane']);
					}
					
					?>
					
				</form>

<!--==================================KONIEC FORMULARZA LOGOWANIA==================================================================-->
				
				
				
			</section>

<!--==================================KONIEC SEKCJI LOGOWANIA==========================================================================-->
		


<!--==================================POCZĄTEK STOPKI STRONY===========================================================================-->

			<footer id="footer">
			
				ciscoptkm.16mb.com &copy; 2017
			
			</footer>
			
<!--==================================KONIEC STOPKI STRONY=============================================================================-->			
			
		</section>
		
<!--==================================KONIEC GŁÓWNEGO POJEMNIKA==========================================================================-->		
	
	</body>
	
</html>