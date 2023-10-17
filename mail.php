<?php 
$errors = '';
$myemail = 'nishantthakur@boopin.com';//<-----Put Your email address here.
$emailList = 'nkthakur4080@gmail.com';
if(empty($_POST['fname']) || empty($_POST['lname'])  ||  empty($_POST['email']) || empty($_POST['comment']))
{
    $errors .= "\n Error: All fields are required";
}

$name = $_POST['fname']." ".$_POST['lname']; 
$email_address = $_POST['email']; 
$message = $_POST['comment']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if(empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message"; 
	
	$headers = "From: $myemail\n" . "X-Mailer: php\r\n"; 
	$headers .= "Reply-To: $email_address";
	//$headers  = "From: no-reply@thepartyfinder.co.uk\r\n" . "X-Mailer: php\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Bcc: $emailList\r\n";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	//header('Location: thank-you.html');
	echo '<div class="alert alert-success">Mail sent</div>';
} 
else{
	echo '<div class="alert alert-warning">Mail not sent</div>';
}
?>