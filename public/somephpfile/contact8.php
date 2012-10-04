<?php
$to = "arthur@melcher.ca";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "chao@melcher.ca";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?> 