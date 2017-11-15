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

	</head>
	
	<body>

<!--==================================POCZĄTEK GŁÓWNEGO POJEMNIKA========================================================================-->
	
		<section id="container">

<!--==================================POCZĄTEK NAGŁÓWKA STRONY======================================================================-->
		
			<header id="header">
		
				Cisco Packet Tracer by KM
		
			</header>

<!--==================================KONIEC NAGŁÓWKA STRONY========================================================================-->
			
			
			
<!--==================================POCZĄTEK NAWIGACJI PROFILOWEJ USERA===============================================================-->

			<nav id="user-nav">
			
			<!-- KAFELKI NAWIGACYJNE - PROFIL USERA -->
			
				<a href="wyloguj.php" title="Wyloguj się!">
					<div class="user-nav-tile" id="panel-one">	<!-- PIERWSZY -->

						Wyloguj
					
					</div>
				</a>
				
				<a href="profil.php" title="Ustawienia profilu">
					<div class="user-nav-tile"  id="panel-two"> <!-- DRUGI -->
				
						Profil
				
					</div>
				</a>
				
		
 
				<a href="users.php" title="Zarządzanie user'ami" >
				
					<div class="user-nav-tile" id="panel-three"> <!-- TRZECI -->
					
						Zarządzanie user'ami
					
					</div>
					
				</a>

				
				<a href="files.php" title="Zarządzanie plikami" >
					<div class="user-nav-tile"  id="panel-four"> <!-- CZWARTY -->
				
						Zarządzanie plikami
				
					</div>
				</a>
				
				<a href="science.php" title="Zarządzanie materiałami" >
					<div class="user-nav-tile"  id="panel-five"> <!-- PIĄTY -->
				
						Zarządzanie lekcjami
				
					</div>
				</a>
			
			<!-- KAFELKI NAWIGACYJNE - KONIEC -->
			
				<div style="clear: both"></div> <!-- pusty div - pomocniczy -->
			
			</nav>
			
<!--==================================KONIEC NAWIGACJI PROFILOWEJ USERA=================================================================-->



<!--==================================POCZĄTEK KONTENERA CONTENTU=====================================================================-->
			
			<section class="content-container"> <!-- TU NAWIGACJA 		-->
			
			<a href="start.php" title="Strona startowa">
				<div class="page-nav-tile" id="nav-tile-one">	<!-- GÓRA LEWO 	-->
					
					<i class="icon-home"></i><br />
					
					Start
				
				</div>
			</a>

			<a href="nauka.php" title="Materiały do nauki">
				<div class="page-nav-tile"  id="nav-tile-two">	<!-- GÓRA PRAWO 	-->
				
				
					<i class="icon-blind"></i><br />
					
					Nauka
				
				</div>
			</a>
			
					<div style="clear: both"></div> <!-- pusty div - pomocniczy -->

			<a href="pliki.php" title="Pliki do pobrania">
				<div class="page-nav-tile"  id="nav-tile-three">	<!-- DÓŁ LEWO 		-->
				
					<i class="icon-folder"></i><br />
					
					Pliki
				
				</div>
			</a>

			<a href="kontakt.php" title="Kontakt">
				<div class="page-nav-tile"  id="nav-tile-four"> <!-- DÓŁ PRAWO 	-->
				
					<i class="icon-mail-alt"></i><br />
					
					Kontakt
				
				</div>
			</a>
			
					<div style="clear: both"></div> <!-- pusty div - pomocniczy -->
			
			</section>
			
			<section class="content-container" style="text-align: center;"> <!-- TU TREŚĆ         		-->
			
				<h1>ADMIN PANEL</h1>
				
				<p>Wybierz czym chcesz zarządzać powyżej.</p>
			
			</section>
			
			<div style="clear: both"></div> <!-- pusty div - pomocniczy 	-->
			
<!--==================================KONIEC KONTENERA CONTENTU=======================================================================-->			
			
			
			
<!--==================================POCZĄTEK STOPKI STRONY==========================================================================-->

			<footer id="footer">
			
				 &copy; ciscoptkm.16mb.com 2017
			
			</footer>
			
<!--==================================KONIEC STOPKI STRONY============================================================================-->			
		
		</section>

<!--==================================KONIEC GŁÓWNEGO POJEMNIKA===========================================================================-->
		
	</body>
	
</html>