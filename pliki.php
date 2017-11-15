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
		<link href="pliki.css" rel="stylesheet" />
		
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
				
				<div class="user-nav-tile"  id="panel-five"> <!-- PIĄTY -->
				</div>
			
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
			
			<section class="content-container" style="margin-top: 30px; margin-bottom: 30px; height: 360px;"> <!-- TU TREŚĆ         		-->
			
						<section id="lekcje-lista">
						
							<div class="lessons-div" style="border-top: 1px solid white;">
								
									<div class="lessons-div-in-one">
									
										Plik
									
									</div>
									
									<div class="lessons-div-in-two">
									
										Opis
									
									</div>
									
									<div style="clear: both;"></div>
									
									<?php
									
										require_once "connect.php";
										
										$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
										
										if($polaczenie->connect_errno!=0)
										{
											echo "Error: ".$polaczenie->connect_errno;
										}
										else
										{
											
											$sql = "SELECT * FROM pliki";
											
											if($rezultat =@$polaczenie->query($sql))
											{
												$ile_lekcji = $rezultat->num_rows;
												if($ile_lekcji>0)
												{
													
													
													$j = 1;
													for($i = 1;$i <= $ile_lekcji;$i++)
													{
														$sql = "SELECT * FROM pliki WHERE id='$j'";
														
															$result = $polaczenie->query($sql);															$ile = $result->num_rows;																														if($ile > 0)															{															
															$followingdata = $result->fetch_assoc();
															
															$nazwa = $followingdata['nazwa'];
															$opis = $followingdata['opis'];
															$sciezka = $followingdata['sciezka'];
echo<<<END
														<a href="$sciezka" title="Pobierz plik" target="_blank">
															<div class="lessons-div-in-one">
									
																$nazwa
															
															</div>
															
															<div class="lessons-div-in-two">
															
																$opis
															
															</div>
															
															<div style="clear: both;"></div>
														</a>
END;																													}															else															{																$i--;															}
															$j++;
														
														
													}
												
												
													
													
													
													
													
													$rezultat->close();
												}
												
											}
											
											$polaczenie->close();
										}
									
									?>
									
								</div>
						</section>
						</section>
					<div style="clear: both;"></div>
					</section>
			
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