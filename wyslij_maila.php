<?php

$to = "marynovski@gmail.com";
$subject = $_POST['temat'];
$message= $_POST['wiadomosc'];



//sprawdzenie czy email nie jest upośledzony
	
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email != $emailB))
	{
		$wszystko_OK = false;
		$_SESSION['e_email'] = '<span style="color: red;">Niepoprawny adres e-mail!</span><br /><br />';
		header('Location: kontakt.php');
		exit();
	}

	
$headers = 'From: '.$emailB;

mail($to, $subject, $message, $headers);


?>