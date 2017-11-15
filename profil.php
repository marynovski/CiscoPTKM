<?php

session_start();

if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
{
	header('Location: index.php');
	exit();
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

<!--==================================POCZ¥TEK G£ÓWNEGO POJEMNIKA========================================================================-->
	
		<section id="container">

<!--==================================POCZ¥TEK NAG£ÓWKA STRONY======================================================================-->
		
			<header id="header">
		
				Cisco Packet Tracer by KM
		
			</header>

<!--==================================KONIEC NAG£ÓWKA STRONY========================================================================-->
			
			
			
<!--==================================POCZ¥TEK NAWIGACJI PROFILOWEJ USERA===============================================================-->

			<nav id="user-nav">
			
			<!-- KAFELKI NAWIGACYJNE - PROFIL USERA -->
			
				<a href="wyloguj.php" title="Wyloguj siÄ™!">
					<div class="user-nav-tile" id="panel-one">	<!-- PIERWSZY -->

						Wyloguj
					
					</div>
				</a>
				
				<a href="profil.php" title="Ustawienia profilu">
					<div class="user-nav-tile"  id="panel-two"> <!-- DRUGI -->
				
						Profil
				
					</div>
				</a>
				
				<?php
				if($_SESSION['admin'] == 'tak')
				{
echo<<<END
 
				<a href="admin.php" title="Panel Administracyjny" >
				
					<div class="user-nav-tile" id="panel-three"> <!-- TRZECI -->
				
						
						
					Admin Panel						
						
						
						
					</div>
				</a>
END;

				}
else
{
echo<<<END
					<div class="user-nav-tile" id="panel-three"> <!-- TRZECI -->
				
						
						
												
						
						
						
					</div>
END;

}
 
				?>
				
				<div class="user-nav-tile"  id="panel-four"> <!-- CZWARTY -->
				</div>
				
				<div class="user-nav-tile"  id="panel-five"> <!-- PI¥TY -->
				</div>
			
			<!-- KAFELKI NAWIGACYJNE - KONIEC -->
			
				<div style="clear: both"></div> <!-- pusty div - pomocniczy -->
			
			</nav>
			
<!--==================================KONIEC NAWIGACJI PROFILOWEJ USERA=================================================================-->



<!--==================================POCZ¥TEK KONTENERA CONTENTU=====================================================================-->
			
			<section class="content-container"> <!-- TU NAWIGACJA 		-->
			
			<a href="start.php" title="Strona startowa">
				<div class="page-nav-tile" id="nav-tile-one">	<!-- GÓRA LEWO 	-->
					
					<i class="icon-home"></i><br />
					
					Start
				
				</div>
			</a>

			<a href="nauka.php" title="MateriaÅ‚y do nauki">
				<div class="page-nav-tile"  id="nav-tile-two">	<!-- GÓRA PRAWO 	-->
				
				
					<i class="icon-blind"></i><br />
					
					Nauka
				
				</div>
			</a>
			
					<div style="clear: both"></div> <!-- pusty div - pomocniczy -->

			<a href="pliki.php" title="Pliki do pobrania">
				<div class="page-nav-tile"  id="nav-tile-three">	<!-- DÓ£ LEWO 		-->
				
					<i class="icon-folder"></i><br />
					
					Pliki
				
				</div>
			</a>

			<a href="kontakt.php" title="Kontakt">
				<div class="page-nav-tile"  id="nav-tile-four"> <!-- DÓ£ PRAWO 	-->
				
					<i class="icon-mail-alt"></i><br />
					
					Kontakt
				
				</div>
			</a>
			
					<div style="clear: both"></div> <!-- pusty div - pomocniczy -->
			
			</section>
			
			<section class="content-container"> <!-- TU TREŒÆ         		-->
			
				<?php
				
				require_once "connect.php";
				
				$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
				
				if($polaczenie->connect_errno!=0)
				{
					echo 'Error: '.$polaczenie->connect_errno;
				}
				else
				{
					$email = $_SESSION['email'];
					$sql = "SELECT id, email FROM users WHERE email='$email'";
					
					if($rezultat=@$polaczenie->query($sql))
					{
						$wiersz = $rezultat->fetch_assoc();
						
						$id = $wiersz['id'];
						$_SESSION['email'] = $wiersz['email'];
						
					}
				}
				
				
				?>
				
				<form method="post" action="change_pass.php">
					Nowe haslo:<br />
					<input type="password" name="haslo1" /><br /><br />
					Powtorz nowe haslo:<br />
					<input type="password" name="haslo2" /><br /><br />
					<input type="submit" value="Zmien haslo" />
				<br /><br />
				</form>
				
				<?php
					if(isset($_SESSION['e_haslo']))
					{
						echo $_SESSION['e_haslo'];
						unset($_SESSION['e_haslo']);
					}
					?>
				
				
				<form method="post" action="change_email.php">
					Aktualny e-mail: <?php echo $_SESSION['email']; ?><br />
					Nowy e-mail:<br />
					<input type="text" name="email" /><br /><br />
					<input type="submit" value="Zmien email" />
					
					<?php
					if(isset($_SESSION['e_email']))
					{
						echo $_SESSION['e_email'];
						unset($_SESSION['e_email']);
					}
					?>
					
					<?php
					
					//if(isset($_SESSION['e_email_change']))
					//{
					//	echo $_SESSION['e_email_change'];
					//	unset $_SESSION['e_email_change'];
					//}
					
					?>
					
				</form>
			
			</section>
			
			<div style="clear: both"></div> <!-- pusty div - pomocniczy 	-->
			
<!--==================================KONIEC KONTENERA CONTENTU=======================================================================-->			
			
			
			
<!--==================================POCZ¥TEK STOPKI STRONY==========================================================================-->

			<footer id="footer">
			
				 &copy; ciscoptkm.16mb.com 2017
			
			</footer>
			
<!--==================================KONIEC STOPKI STRONY============================================================================-->			
		
		</section>

<!--==================================KONIEC G£ÓWNEGO POJEMNIKA===========================================================================-->
		
	</body>
	
</html>