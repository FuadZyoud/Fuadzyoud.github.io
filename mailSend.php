<?php
if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "fms.zyoud@gmail.com";
	$email_subject = "Fuad Al Zyoud website";
	
	
	function died($error) {
		// your error code can go here
		echo '<script type="text/javascript">alert("We are sorry, but there is errors found with the form you submitted.");window.location = "index.html";</script>';
		echo $error."<br /><br />";
		echo '<script type="text/javascript">alert("Please go back and fix these errors.");window.location = "index.html";</script>';
		die();
		
	}
	
	// validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['message'])) {
		died('<script type="text/javascript">alert("Please go back and fix these errors.");window.location = "index.html";</script>');		
	}
	
	$name = $_POST['name']; // required
	$email = $_POST['email']; // required
	$message = $_POST['message']; // required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
  	$error_message .= '<script language="javascript" type="text/javascript">
		alert("The Email Address you entered does not appear to be valid.");window.location = "index.html";</script>"<br />';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
  	$error_message .= '<script language="javascript" type="text/javascript">
		alert("The Name you entered does not appear to be valid.");window.location = "index.html";</script>"<br />';
  }
  if(strlen($message) < 2) {
  	$error_message .= '<script language="javascript" type="text/javascript">
		alert("The Comments you entered do not appear to be valid."); window.location = "index.html";</script>"<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email)."\n";
	$email_message .= "Comments: ".clean_string($message)."\n";
	
	
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- place your own success html below -->
<html>
  
<body>
		<script language="javascript" type="text/javascript">
		alert("Thanks.");window.location = "index.html";</script>

</body>
</html>
<?php
}
die();
?>