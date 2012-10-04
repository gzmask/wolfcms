<?php
/*  
 * @package Plugins
 * fm_contact - A contact form pulgin for Wolf CMS for HTML 
 * Copyright (C) 2012 Fredy Mettler <homepage@hotmail.ch> 
 * @author Fredy Mettler <homepage@hotmail.ch> 
 *  Version 1.0.0  
 */
/* Security measure */
if (!defined('IN_CMS')) { exit(); }

?>
<h1><?php echo __('Documentation for fm_contact'); ?></h1>

<p>This is a contact formula for your homepage. </br> You only need insert this code 
"<strong>&lt;?php fm_contact(); ?&gt;</strong>" on your page. </br> 
Please, change the mail address in the settings with your one. </br>
</p>

<h2>Features</h2>
<p> 
    You can also change all the labels for the contact form.  </br>
    So you can choose your one language for example. </br> </br> 
    There is an extra field, were you can show or hidden from your site. </br>
    And, you can also choose for this extra field, is it only allowed for numbers. </br>
    This extra field will not be checked, is it fill out or not by sending a mail. </br>
</p>
<h2> <b>Important </b></h2>
<p>In the Settings, you are responsible that the input you set in, make sense.</br>
   For the label of the botton, there is only one single word allowed,</br>
   or connected more words with underline between. </br></br>
   
   For all other inputs (labels and error massages) you can use your one <strong>html tag</strong> if you like. </br></br>
   <b>For example:</b></br> 
   Instead of using the standart letter like so:-></br>
   Please, fill out the fields marked with * and also the entry code!</br> </br>
   you can use it, for example with HTML tap like so -></br>
   &lt;font color="#FF0000"&gt;<font color="#FF0000">Please, fill out the fields marked with * and also the entry code!</font>&lt;/font&gt;&lt;br&gt;</br></br>
   The <strong>semicolon (;) isn't allowed </strong>to use for labels and so on, because this parameter will be save in a .csv file.
</p>
<h2>Knows about fm_contact</h2>
<p>The settings will be saved in the file "parameter.csv"</br></br>

   Das Benutzen der Tools geschieht auf eigne Gefahr. Ich übernehme keinerlei Haftung.
   Ich kann auch nicht für Schäden oder Unkosten durch die Tools haftbar gemacht werden.
</p>


