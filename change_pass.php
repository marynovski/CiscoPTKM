<?PHP

session_start();

$email =  $_POST['email'];
$id = $_SESSION['aktualny_id'];

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!= 0)
{
	echo "Error: ".$polaczenie->connect_errno;
}
else
{
	//sprawdzenie czy email nie jest upośledzony
	
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
			
	$haslo1 = $_POST['haslo1'];		
	$haslo2 = $_POST['haslo2'];

	if($haslo1 != $haslo2)
	{
		$_SESSION['e_haslo'] = '<span style="color: red;">Hasła muszą być zgodne!</span><br /><br />';
	}
	else if((strlen($haslo1) < 8) || (strlen($haslo1) > 20))
	{
		$wszystko_OK = false;
		$_SESSION['e_haslo'] = '<span style="color: red;">Hasło musi posiadać od 8 do 20 znaków!</span><br /><br />';
	}
	else
	{
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
			

		$sql = "UPDATE users SET pass='$haslo_hash' WHERE id='$id'";
		$rezultat = $polaczenie->query($sql);
	}
	
	
	$polaczenie->close();
	header('Location: profil.php');
}


?>
