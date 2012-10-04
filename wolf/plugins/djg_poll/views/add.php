<?php

/**
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS.
 *
 * Wolf CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Wolf CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Wolf CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Wolf CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */

/**
 * The djg_poll plugin

 * @author Micha³ Uchnast <djgprv@gmail.com>,
 * @copyright kreacjawww.pl
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */

?>
<h1><?php echo __('Add poll'); ?></h1>
<div id="djg_poll">
<form id="djg_poll_form" action="<?php echo get_url('plugin/djg_poll/add'); ?>" method="post">
    <fieldset style="padding: 0.5em;">
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
			<input type="hidden" name="djg_poll[id]" value="0" />
			<tr>
                <td class="label"><label for="question"><?php echo __('Poll question'); ?>: </label></td>
                <td>
					<textarea id="question" name="djg_poll[q]" ><?php if($djg_poll['q']) echo $djg_poll['q']; ?></textarea>
				</td>
        <td class="help"></td>
			</tr>
            <tr class="u_area">
                <td class="label">
					<?php echo __('Poll answers'); ?>
					<a href="#" class="add_answer"><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/djg_cf/images/16_add.png" alt="<?php echo __('add subject'); ?>" title="<?php echo __('add subject'); ?>" /></a>
				</td>
                <td class="field">
					<ul class="a">
						<?php $djg_poll_a = ($djg_poll['a']) ? count($djg_poll['a']) : 2; ?>
						<?php for ($i=0; $i < $djg_poll_a; $i++): ?>
							<li><input name="djg_poll[a][]" type="text" value="<?php echo $djg_poll['a'][$i]; ?>" class="djg_poll_answare" /><a href="#" class="remove_answer"><img src="<?php echo URL_PUBLIC; ?>wolf/plugins/djg_cf/images/16_remove.png" alt="<?php echo __('remove_answer'); ?>" title="<?php echo __('remove_answer'); ?>" /></a></li>
						<?php endfor; ?>
					</ul>
				</td>
                <td class="help"><?php echo __('Click <strong>plus</strong> icon to add another answer or <strong>x</strong> icon to remove current.'); ?></td>
            </tr>
			<tr>
        <td class="label"><?php echo __('Multiple'); ?>: </label></td>
        <td class="field">
          <select id="subject" name="djg_poll[multiple]">
						<option value="0" <?php if($djg_poll['multiple'] == "0") echo 'selected="selected"' ?>><?php echo __('no'); ?></option>
						<option value="1" <?php if($djg_poll['multiple'] == "1") echo 'selected="selected"' ?>><?php echo __('yes'); ?></option>
					</select>	
				</td>
				<td class="help"><?php echo __('Allows users to select more than one answere?'); ?></td>
			</tr>
			<tr>
        <td class="label"><?php echo __('Is active'); ?>: </label></td>
        <td class="field">
          <select id="subject" name="djg_poll[active]">
						<option value="0" <?php if($djg_poll['active'] == "0") echo 'selected="selected"' ?>><?php echo __('no'); ?></option>
						<option value="1" <?php if($djg_poll['active'] == "1") echo 'selected="selected"' ?>><?php echo __('yes'); ?></option>
					</select>	
				</td>
				<td class="help"><?php echo __('Passible to vote.'); ?></td>
			</tr>
			<tr>
         <td class="label"><?php echo __('Time between votes'); ?>: </label></td>
          <td class="field">
					<select id="subject" name="djg_poll[timestamp]">
            <option value="0" <?php if($djg_poll['timestamp'] == 0) echo 'selected="selected"' ?>><?php echo __('no restrictions'); ?></option>
						<option value="1" <?php if($djg_poll['timestamp'] == 1) echo 'selected="selected"' ?>><?php echo __('every hour'); ?></option>
						<option value="24" <?php if($djg_poll['timestamp'] == 1*24) echo 'selected="selected"' ?>><?php echo __('once a day'); ?></option>
						<option value="168" <?php if($djg_poll['timestamp'] == 1*24*7) echo 'selected="selected"' ?>><?php echo __('every 7 Days'); ?></option>
            <option value="720" <?php if($djg_poll['timestamp'] == 1*24*30) echo 'selected="selected"' ?>><?php echo __('every 30 Days'); ?></option>
            <option value="8760" <?php if($djg_poll['timestamp'] == 1*24*365) echo 'selected="selected"' ?>><?php echo __('every 365 Days'); ?></option>
           </select>
				</td>
				 <td class="help"><?php echo __(''); ?></td>
			</tr>
<tr>
        <td class="label"></td>
        <td class="field">
           
 
    
				</td>
				<td class="help"></td>
			</tr>

			
      <!-- 
			<tr>
          <td class="label"><?php echo __('Start date'); ?>: </label></td>
          <td class="field">
					<?php $start_date = ($djg_poll['start_date']) ? $djg_poll['start_date']:date('Y-m-d'); ?>
					<input id="djg_poll_start_date" maxlength="10" name="djg_poll[start_date]" READONLY size="10" type="text" value="<?php echo substr($start_date, 0, 10); ?>" />
          <img class="datepicker" onclick="displayDatePicker('djg_poll[start_date]');" src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon_cal.gif" alt="<?php echo __('Show Calendar'); ?>" />
          <?php echo __('Hour:'); ?>        
          <select id="subject" name="djg_poll[start_h]" size="1">
            <?php for($i=0;$i<=23;$i=$i+1): ?>
              <option value="<?php echo $i; ?>" <?php if($djg_poll['start_h'] == $i) echo 'selected="selected"' ?>><?php echo $i; ?></option>
            <?php endfor; ?>
					</select>
          <?php echo __('Minute:'); ?>
          <select id="subject" name="djg_poll[start_m]">
            <?php for($i=0;$i<=59;$i=$i+10): ?>
              <option value="<?php echo $i; ?>" <?php if($djg_poll['start_m'] == $i) echo 'selected="selected"' ?>><?php echo $i; ?></option>
            <?php endfor; ?>
					</select>
          </td>
				 <td class="help"><?php echo __(''); ?></td>
			</tr>
      -->
        </table>
    </fieldset>
    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    </p>

</form>
</div>              
<script type="text/javascript">
// <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }
    function unloadMessage() {
        return '<?php echo __('You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }
	$(document).ready(function() {
		$('input').attr('autocomplete','off');
		
		$(':input').bind('change', function() { setConfirmUnload(true); });
		$('form').submit(function() {$(this).find('.button').remove(); setConfirmUnload(false); return true; });
		$('.add_answer').click(function() {
		$(".a").append('<li>'
								  + '<input name="djg_poll[a][]" type="input" class="djg_poll_answare" />'
								  + '<a href="#" class="remove_answer">'
								  + '<img src="<?php echo URL_PUBLIC; ?>wolf/plugins/djg_cf/images/16_remove.png" alt="<?php echo __('remove_answer'); ?>" title="<?php echo __('remove_answer'); ?>" />'
								  + '</a></li>');
		return false;
	});
	$('.remove_answer').live('click', function() {
		if($(".a li").size() > 2){
      $(this).parent().remove();return false;
		}else{
      alert('<?php echo __('The minimum quantity is two.'); ?>');
		}
	});

});
// ]]>
</script>