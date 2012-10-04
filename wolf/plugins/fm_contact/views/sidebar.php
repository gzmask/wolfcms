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

/**
 */
?>
<p class="button"><a href="<?php echo get_url('plugin/fm_contact/documentation'); ?>"><img align="middle" alt="<?php echo __('Documentation'); ?>" src="<?php echo ICONS_URI . 'page-32.png';?>" /><?php echo __('Documentation'); ?></a></p>

<p>This is a contact formular for your homepage. </br> You only need insert this code on your page. </br>
<strong>&lt;?php fm_contact(); ?&gt;</strong> 
</p>

<p class="button"><a href="<?php echo get_url('plugin/fm_contact/settings'); ?>"><img align="middle" alt="<?php echo __('Settings'); ?>" src="<?php echo ICONS_URI . 'settings-32.png';?>" /><?php echo __('Settings'); ?></a></p>
 <h3>Example Image:</h3>
<img src="./wolf/plugins/fm_contact/views/contact.jpg" alt="contact" /> 