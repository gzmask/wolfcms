<?php $name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent="From: $name \n Message: $message";
$recipient = "arthur@melcher.ca";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";

mail($recipient, $formcontent, $subject, $mailheader) or die("Error!");
echo "Thank You!";
?>