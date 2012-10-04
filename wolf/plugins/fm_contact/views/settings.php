<h1><?php echo __('fm_contact Form Settings'); ?></h1>
<p><font color="#FF0000">The <strong>semicolon (;) isn't allowed </strong>to use for labels and so on, because this parameter will be save in a .csv file.</font></p>
<?php
/*  
 * @package Plugins
 * fm_contact - A contact form pulgin for Wolf CMS for HTML 
 * Copyright (C) 2012 Fredy Mettler <homepage@hotmail.ch> 
 * @author Fredy Mettler <homepage@hotmail.ch> 
 *  Version 1.0.0  
 */
 //echo getcwd()."<br>"; der Path sollte das home deiner Webseite sein zB:wolfcms 
 $path  = "./wolf/plugins/fm_contact";

//Namen aus dem File laden und Anhand dem Index aus dem HTML Formular auslesen   
$data = file_get_contents($path."/parameter/parameter.csv");              
$parameter = explode(";", $data);

$email_to         = $parameter[0];
$first_name       = $parameter[1];
$last_name        = $parameter[2]; 
$email_from       = $parameter[3]; 
$extra_field      = $parameter[4]; 

$comments         = $parameter[5];
$code_commend     = $parameter[6];
$send             = $parameter[7]; 
$reload           = $parameter[8];

$extra_field_true    = $parameter[9];
$extra_field_numbers = $parameter[18];

$fehler_emty      = $parameter[10];
$fehler_code      = $parameter[11];
$fehler_mail      = $parameter[12];
$fehler_first     = $parameter[13];
$fehler_last      = $parameter[14];
$fehler_tel       = $parameter[15];
$fehler_com       = $parameter[16];
$thanks           = $parameter[17];


if(isset($_POST['submit'])){

    $email_to = $_POST['email_to'];
    $first_name = $_POST['first_name']; 
    $last_name  = $_POST['last_name']; 
    $email_from = $_POST['email_from'];
    $extra_field  = $_POST['extra_field'];
    
    $comments   = $_POST['comments']; 
    $code_commend = $_POST['code_commend']; 
    $send = $_POST['send']; 
    $reload = $_POST['reload'];
    $fehler_emty = $_POST['fehler_emty'];
    $fehler_code = $_POST['fehler_code'];
    $fehler_mail = $_POST['fehler_mail'];
    $fehler_first = $_POST['fehler_first'];
    $fehler_last  = $_POST['fehler_last'];
    $fehler_tel   = $_POST['fehler_tel'];
    $fehler_com   = $_POST['fehler_com'];
    $thanks       = $_POST['thanks'];
    
    
    $extra_field_true    = $_POST['extra_field_true'];
    $extra_field_numbers = $_POST['extra_field_numbers'];  

   $ersetzen =  $email_to.";".$first_name.";".$last_name.";".$email_from.";"
                .$extra_field.";".$comments.";".$code_commend.";".$send.";" 
                .$reload.";".$extra_field_true.";".$fehler_emty.";"
                .$fehler_code.";".$fehler_mail.";".$fehler_first.";"
                .$fehler_last.";".$fehler_tel.";".$fehler_com.";".$thanks.";".$extra_field_numbers.";*";
   // echo $ersetzen;     

   $datei=fopen($path."/parameter/parameter.csv","w");
if ($datei)
    {
    $output=fwrite($datei,$ersetzen);
    fclose($datei);
    }   
}
  ?>
 
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">


    <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Change the default settings'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('You mail address:');?> </label></td>
                <td class="field"><input name="email_to" id="email_to" type="text" size="35" maxsize="255" value="<?php echo $email_to;?>"/></td>
                <td class="help"><?php echo __('Change the example mail address with your one.<br/>For example: <code>your.name@adress.ch</code>');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('First field label:');?> </label></td>
                <td class="field"><input name="first_name" id="first_name" type="text" size="35" maxsize="255" value="<?php echo $first_name;?>"/></td>
                <td class="help"><?php echo __('Change the label from the first field');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Second field label:');?> </label></td>
                <td class="field"><input name="last_name" id="last_name" type="text" size="35" maxsize="255" value="<?php echo $last_name;?>"/></td>
                <td class="help"><?php echo __('Here, you can change the label from the second field');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Third field label::');?> </label></td>
                <td class="field"><input name="email_from" id="email_from" type="text" size="35" maxsize="255" value="<?php echo $email_from;?>"/></td>
                <td class="help"><?php echo __('Here, you can change the label from the third field');?></td>
            </tr>        
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Fifth field label:');?> </label></td>
                <td class="field"><input name="comments" id="comments" type="text" size="35" maxsize="255" value="<?php echo $comments;?>"/></td>
                <td class="help"><?php echo __('Change the label from the fifth field for comments');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Enter code comments:');?> </label></td>
                <td class="field"><input name="code_commend" id="code_commend" type="text" size="35" maxsize="255" value="<?php echo $code_commend;?>"/></td>
                <td class="help"><?php echo __('Change the text for the code enters.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Send bottom:');?> </label></td>
                <td class="field"><input name="send" id="send" type="text" size="35" maxsize="255" value="<?php echo $send;?>"/></td>
                <td class="help"><?php echo __('Change the label for the send bottom.<br/><code>It is only allowed one word or connected with underline</code>');?></td>
            </tr> 
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Reload bottom:');?> </label></td>
                <td class="field"><input name="reload" id="reload" type="text" size="35" maxsize="255" value="<?php echo $reload;?>"/></td>
                <td class="help"><?php echo __('Change the label for the code reload bottom. This is useful if the cord readable.<br/><code>It is only allowed one word or connected with underline</code>');?></td>
            </tr>
        </table>
    </fieldset> 
    
    <fieldset style="padding: 0.5em;">
       <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('An extra field'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">            
            <tr>
                <td class="label"><label for="listhidden"><?php echo __('An extra field:'); ?> </label></td>
                <td class="field"><input name="extra_field_true" id="extra_field_true" type="checkbox" <?php echo ($extra_field_true ? 'checked="true"' : ''); ?>/></td>
                <td class="help"><?php echo __('If you need an additional field, check here.<br/>This field will not be checked, is it fill out or not by sending the mail'); ?></td>
            </tr> 
             <tr>
                <td class="label"><label for="listhidden"><?php echo __('Only input numbers:'); ?> </label></td>
                <td class="field"><input name="extra_field_numbers" id="extra_field_true" type="checkbox" <?php echo ($extra_field_numbers ? 'checked="true"' : ''); ?>/></td>
                <td class="help"><?php echo __('If you would like only allowed numbers in this extra field,<br/> for examples telephone number, then check here.'); ?></td>
            </tr>                         
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Fourth field label:');?> </label></td>
                <td class="field"><input name="extra_field" id="extra_field" type="text" size="35" maxsize="255" value="<?php echo $extra_field;?>"/></td>
                <td class="help"><?php echo __('Change the label from the fourth respectively extra field.<br/>
                                                <code>You can us this field for an extra input.<br/> 
                                                This field will not be checked, is it fill out or not by sending the mail.</code>');?></td>
            </tr>    
          </table>
    </fieldset>   
                                                                               
     <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Change the default ERROR Message'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">

            <tr>
                <td class="label"><label for="fehler_emty"><?php echo __('If one or more field empty:');?> </label></td>   
                <td class="top"><textarea  name="fehler_emty"><?php echo $fehler_emty ?></textarea> </td>
                <td class="help"><?php echo __('The error message, when one field is still empty.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_code"><?php echo __('If the code wrong:');?> </label></td>   
                <td class="top"><textarea  name="fehler_code"><?php echo $fehler_code ?></textarea> </td>
                <td class="help"><?php echo __('The error message, when the security code is wrong.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_mail"><?php echo __('If the mail wrong:');?> </label></td>   
                <td class="top"><textarea  name="fehler_mail"><?php echo $fehler_mail ?></textarea> </td>
                <td class="help"><?php echo __('The error message, when the mail address is not conforms.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_first"><?php echo __('If the first name wrong:');?> </label></td>   
                <td class="top"><textarea  name="fehler_first"><?php echo $fehler_first ?></textarea> </td>
                <td class="help"><?php echo __('The error message, when in the name space is not a letter.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_last"><?php echo __('If the last name wrong:');?> </label></td>   
                <td class="top"><textarea  name="fehler_last"><?php echo $fehler_last ?></textarea> </td>
                <td class="help"><?php echo __('The error message, when in the name space is not a letter.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_tel"><?php echo __('If the tel. wrong:');?> </label></td>   
                <td class="top"><textarea  name="fehler_tel"><?php echo $fehler_tel ?></textarea> </td>
                <td class="help"><?php echo __('The error message for your extra field.');?></td>
            </tr>
            <tr>
                <td class="label"><label for="fehler_com"><?php echo __('If the comments not convenient:');?> </label></td>   
                <td class="top"><textarea  name="fehler_com"><?php echo $fehler_com ?></textarea> </td>
                <td class="help"><?php echo __('The error message for the comments input.');?></td>
            </tr> 
            <tr>
                <td class="label"><label for="thanks"><?php echo __('If the send was successful:');?> </label></td>   
                <td class="top"><textarea  name="thanks"><?php echo $thanks ?></textarea> </td>
                <td class="help"><?php echo __('The message when the mail is send successful.');?></td>
            </tr>                                                                          
        </table>
    </fieldset>
    <br/>

     <input type="submit" value=Save name='submit'/>

</form>
 <?php

 echo getcwd()."<br>"; //der Path sollte das home deiner Webseite sein zB:wolfcms 
?>
