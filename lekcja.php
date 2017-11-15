<?php

session_start();

if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
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
					$id = $_POST['id_lekcji'];
					$sql = "SELECT * FROM lekcje WHERE id='$id'";
					
					if($rezultat=@$polaczenie->query($sql))
					{
						$wiersz = $rezultat->fetch_assoc();
						
						$nr_lekcji = $wiersz['nr_lekcji'];
						$temat = $wiersz['temat'];
						$opis = $wiersz['opis'];
						$adres_yt = $wiersz['adres_yt'];
						
						$polaczenie->close();
					
					}
					else
					{
						$polaczenie->close();
						header('Location: nauka.php');
						exit(0);
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
	
		<body style="text-align: center;">
	
								
			<header>
			
				<?php echo '<h2>'.$id.'. '.$temat.'</h2>'; ?>
			
			</header>
			
			<section id="odtwarzacz_yt">
			
				<?php echo $adres_yt; ?>
			
			</section>

			<section id="opis">
			
				<?php echo $opis; ?>
			
			</section>


				<h3><a href="files.php" title="idź sobie" class="mark" />Powrót do strony</a></h3>
				
				
			



			<footer>
			
				ciscoptkm.16mb.com &copy; 2017
			
			</footer>
			
		
	
	</body>
	
</html>