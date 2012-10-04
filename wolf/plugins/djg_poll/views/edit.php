<?php if (!defined('IN_CMS')) { exit(); } ?>
<?php $questionId = (isset($questionId)) ? $questionId : 0; ?>
<?php $pageId = (isset($pageId)) ? $pageId : 1; ?>
<?php if ( (count($djg_poll['pollq_id'])==0) or ($djg_poll['pollq_id'] != $questionId ) ): ?>
<?php redirect(get_url('plugin/djg_poll/polls/'.$pageId)); ?>
<?php else: ?>
<h1><?php echo __('Edit: :question',array(':question'=>'('.$djg_poll['pollq_id'].') ' . Djgpoll::truncate($djg_poll['pollq_question'],50,'...',false))); ?></h1>
<div id="djg_poll">
<form id="djg_poll_form" action="<?php echo get_url('plugin/djg_poll/edit/'.$questionId.'/'.$pageId); ?>" method="post">
    <fieldset style="padding: 0.5em;">
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
			<input type="hidden" name="djg_poll[questionId]" value="<?php echo $questionId; ?>" />
			<tr>
        <td class="label"><?php echo __('Multiple'); ?>: </label></td>
        <td class="field">
          <select id="subject" name="djg_poll[multiple]">
						<option value="0" <?php if($djg_poll['pollq_multiple'] == "0") echo 'selected="selected"' ?>><?php echo __('no'); ?></option>
						<option value="1" <?php if($djg_poll['pollq_multiple'] == "1") echo 'selected="selected"' ?>><?php echo __('yes'); ?></option>
					</select>	
				</td>
				<td class="help"><?php echo __('Allows users to select more than one answere?'); ?></td>
			</tr>
			<tr>
        <td class="label"><?php echo __('Is active'); ?>: </label></td>
        <td class="field">
          <select id="subject" name="djg_poll[active]">
						<option value="0" <?php if($djg_poll['pollq_active'] == "0") echo 'selected="selected"' ?>><?php echo __('no'); ?></option>
						<option value="1" <?php if($djg_poll['pollq_active'] == "1") echo 'selected="selected"' ?>><?php echo __('yes'); ?></option>
					</select>	
				</td>
				<td class="help"><?php echo __('Passible to vote.'); ?></td>
			</tr>
			<tr>
         <td class="label"><?php echo __('Time between votes'); ?>: </label></td>
          <td class="field">
					<select id="subject" name="djg_poll[timestamp]">
            <option value="0" <?php if($djg_poll['pollq_timestamp'] == 0) echo 'selected="selected"' ?>><?php echo __('no restrictions'); ?></option>
						<option value="1" <?php if($djg_poll['pollq_timestamp'] == 1) echo 'selected="selected"' ?>><?php echo __('every hour'); ?></option>
						<option value="24" <?php if($djg_poll['pollq_timestamp'] == 1*24) echo 'selected="selected"' ?>><?php echo __('once a day'); ?></option>
						<option value="168" <?php if($djg_poll['pollq_timestamp'] == 1*24*7) echo 'selected="selected"' ?>><?php echo __('every 7 Days'); ?></option>
            <option value="720" <?php if($djg_poll['pollq_timestamp'] == 1*24*30) echo 'selected="selected"' ?>><?php echo __('every 30 Days'); ?></option>
            <option value="8760" <?php if($djg_poll['pollq_timestamp'] == 1*24*365) echo 'selected="selected"' ?>><?php echo __('every 365 Days'); ?></option>
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
        </table>
    </fieldset>
    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save Changes'); ?>" /> | <a href="<?php echo get_url('plugin/djg_poll/polls/'.$pageId); ?>"><?php echo __('Back to list of all polls'); ?></a>   
    </p>
</form>
</div>
<?php endif; ?> 
<script type="text/javascript">
// <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }
    function unloadMessage() {
        return '<?php echo __('You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }
// ]]>
</script>