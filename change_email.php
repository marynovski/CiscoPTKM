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
			
			
			
			$ile_maili = $rezultat->num_rows;
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email != $emailB))
	{
		$wszystko_OK = false;
		$_SESSION['e_email'] = '<span style="color: red;">Niepoprawny adres e-mail!</span><br /><br />';
	}
	else if($ile_maili > 0)
	{
				$wszystko_OK = false;
				$_SESSION['e_email'] = '<span style="color: red;">Istnieje już konto przypisane do tego adresu email!</span><br /><br />';
	}
	else
	{
		$sql = "UPDATE users SET email='$email' WHERE id='$id'";
		$_SESSION['email'] = $email;
		$rezultat = $polaczenie->query($sql);
	}
	
	
	$polaczenie->close();
	header('Location: profil.php');
}


?>
