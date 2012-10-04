<?php
/*  
 * @package Plugins
 * fm_contact - A contact form pulgin for Wolf CMS for HTML 
 * Copyright (C) 2012 Fredy Mettler <homepage@hotmail.ch> 
 * @author Fredy Mettler <homepage@hotmail.ch> 
 *  Version 1.0.0  
 */
session_start();
if (!defined('IN_CMS')) { exit(); }

Plugin::setInfos(array(
    'id'          => 'fm_contact',
    'title'       => 'Contact Formular', 
    'description' => 'Web-Mail Contact Formular.', 
    'version'     => '1.0.1',
    'author'      => 'Fredy Mettler',
    'website'     => 'http://www.wolfcms.org/',

));
 

Plugin::addController('fm_contact', 'Contact Formular');

function fm_contact() {

 //echo getcwd()."<br>"; der Path sollte das home deiner Webseite sein zB:wolfcms 
 $path  = "./wolf/plugins/fm_contact";
  
$data = file_get_contents($path."/parameter/parameter.csv");              
$parameter = explode(";", $data);

$email_to       = $parameter[0];
$strFrom        = '"Formmailer" <wolf_web@mail.ch>';
$strSubject     = 'Bemerkung zum WEB-Kalender';
$first_name   ='';
$last_name    =''; 
$email_from   =''; 
$telephone    =''; 
$comments     =''; 
$enter_code   ='';
$possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
$code = '';
$end = 0;

$i = 0;
while ($i < 5) { 
$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
$i++;
}

$strDelimiter  = ":\t";

if(isset($_POST['submit'])){
    $end = 0;
    $first_name = strip_tags($_POST['first_name']); 
    $last_name  = strip_tags($_POST['last_name']); 
    $email_from = strip_tags($_POST['email']);
    $telephone  = strip_tags($_POST['telephone']); 
    $comments   = strip_tags($_POST['comments']); 
    $enter_code = strip_tags($_POST['code']); 
    
if  ($first_name && $last_name &&  $email_from &&  $comments && $enter_code)
 {   
      $error_message = "";
      $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
      $string_exp = "/^[A-Za-z .'-]+$/";
      
      if(!preg_match($email_exp,$email_from)) {
          $error_message .= $parameter[12].'<br />';
         }
      
      if(!preg_match($string_exp,$first_name)) {
          $error_message .= $parameter[13].'<br />';
         }
  
      if(!preg_match($string_exp,$last_name)) {
        $error_message .= $parameter[14].'<br />';
        }
        
       if(strlen($comments) < 2) {
        $error_message .= $parameter[16].'<br />';
        }
      if   ($parameter[18] == on) {
         if($telephone)  {
            if(!is_numeric($telephone )) {
                $error_message .= $parameter[15].'<br />';
              }
          }
       } 
       if(isset($_SESSION['captcha_spam']) AND $enter_code != $_SESSION['captcha_spam']){
                unset($_SESSION['captcha_spam']);
                $error_message .= $parameter[11].'<br />';
       } 
            
    if(strlen($error_message) > 0) {
            echo  $error_message;
      }
  
    else{
       
        $email_subject = "WebSite WolfCMS";
        $email_message = "Form details below.\n\n";
        $email_message .= $parameter[1].":  ".$first_name."\n";
        $email_message .= $parameter[2].":  ".$last_name."\n";
        $email_message .= $parameter[3].":  ".$email_from."\n";
        $email_message .= $parameter[4].":  ".$telephone."\n";
        $email_message .= $parameter[5].":  ".$comments."\n";
     
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         mail($email_to, $email_subject, $email_message, $headers); 

        echo $parameter[17];
      $end = 1;
     }
  } 
  else{ 
      echo $parameter[10].'</br>';                                 
  }
}
 
if($end == 0){ 
 ?>
 
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<br>
<table width="450px">
<tr>
 <td valign="top"><label for="first_name"><?php echo $parameter[1];?> *</label></td>
 <td valign="top"><input  type="text" name="first_name" 
     value="<?php echo $first_name; ?>"maxlength="50" size="30"></td>
 
</tr>
<tr>
 <td valign="top""><label for="last_name"><?php echo $parameter[2];?> *</label> </td>
 <td valign="top"><input  type="text" name="last_name" 
     value="<?php echo $last_name; ?>"maxlength="50" size="30"></td>
</tr>
<tr>
 <td valign="top"><label for="email"><?php echo $parameter[3];?> *</label></td>
 <td valign="top"> <input  type="text" name="email" 
     value="<?php echo $email_from ?>"maxlength="80" size="30"> </td>
</tr>
<?php 

if   ($parameter[9] == on) {
    echo"<tr>
    <td valign='top'> <label for='telephone'>". $parameter[4]."</label> </td>
    <td valign='top'> <input  type='text' name='telephone' 
    value='".$telephone."'"." maxlength='30' size='30' ></td></tr>";
  }  
?>
    
<tr>
 <td valign="top"><label for="comments"><?php echo $parameter[5];?> *</label></td>
 <td valign="top"><textarea  name="comments" cols="25" rows="6"><?php echo $comments ?></textarea> </td>
</tr>
<tr>
 <td> <img src="<?php echo $path ?>/capcha/captchar.php" id='captcha' border="0" title="Sicherheitscode"> </td>
 <td > <input  type="text" name="code" maxlength="6" size="6"> <?php echo $parameter[6];?></td>
</tr>
<tr>
 <td  > </td>         
 <td  > <input type="submit" value=<?php echo $parameter[7];?> name='submit'/> 
 <input type="button" value=<?php echo $parameter[8];?> onclick="var heute = new Date(); 
       document.getElementById('captcha').src='<?php echo $path ?>/capcha/captchar.php?'+heute.getTime()" />
  </td>
</tr>
</table>
</form>
<?php
 }
}
?>
