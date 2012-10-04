<?php if (!defined('IN_CMS')) { exit(); } ?>
<h1><?php echo __('List of all polls'); ?></h1>
<div style="margin: 1em auto; padding: 0.1em;">
		<?php
		use_helper('Pagination');
		$__CMS_CONN__ = Record::getConnection();
		$pollq = $__CMS_CONN__->query('SELECT pollq_id FROM '.TABLE_PREFIX.'djg_pollsq ');
		$listLimit = 3;
		$listCount = count($pollq->fetchAll(PDO::FETCH_ASSOC));
		$listOffset = ($page_number-1) * $listLimit;
		($listOffset>0) ? $offsetQuery = ' OFFSET '.$listOffset : $offsetQuery = '';
		
		$pollq = $__CMS_CONN__->query('SELECT * FROM '.TABLE_PREFIX.'djg_pollsq ORDER BY pollq_id DESC LIMIT ' . $listLimit . $offsetQuery);
		$polls = $pollq->fetchAll();
		
		$pagination = new Pagination(array(
		'base_url'		=> get_url('plugin/djg_poll/polls/'),
		'total_rows'	=> $listCount, // Total number of items (database results)
		'per_page'      => $listLimit, // Max number of items you want shown per page
		'num_links'     => 3, // Number of "digit" links to show before/after the currently viewed page
		'cur_page'      => $page_number, // The current page being viewed
		));
		?>
	<div class ="pagination">
		<?php
		echo __('Total: :count polls',array(':count' => $listCount));
		echo $pagination->createLinks();
		?>
	</div>
<table id="djg_poll_list">
	<thead>
		<td class="page_id">id</td>
		<td class="question"><?php echo __('question'); ?></td>
		<td class="date"><?php echo __('date'); ?></td>
		<td class="actions"><?php echo __('actions'); ?></td>
	</thead>
	<tbody>
<?php
	if (count($polls)>0):
	foreach ($polls as $poll):
	$pn = ($page_number!=0)?$page_number:'0';
    $currentStatus = ((int)$poll['pollq_active']==1)?'16_on.png':'16_off.png';
		echo '<tr class="' .  even_odd() . '">';
		echo '<td class="page_id">' . (int)$poll['pollq_id'] .'</td>' . 
			'<td class="question">' . Djgpoll::truncate($poll['pollq_question'],20) .'</td>' . 
		    //'<td class="date">' . DateDifference::getString(new DateTime($poll['pollq_date'])) . '</td>' . 
        '<td class="date">' . $poll['pollq_date'] . '</td>' . 
		    '<td class="actions">' . // actions below
			'<div class="actions_wrapper">' . 
			'<a href="' . get_url('plugin/djg_poll/edit') . '/' . (int)$poll['pollq_id'] . '/'.$pn.'"><img src="' . PLUGINS_URI.'djg_poll/images/16_edit.png' . '" alt="'.__('edit poll').'"></a> ' .
      '<a href="' . get_url('plugin/djg_poll/onOff') . '/' . (int)$poll['pollq_id'] . '/'.$pn.'"><img src="' . PLUGINS_URI.'djg_poll/images/' . $currentStatus . '" alt=""></a> '.
      '<a href="' . get_url('plugin/djg_poll/delete') . '/' . (int)$poll['pollq_id'] . '/'.$pn.'"';
      echo "onclick=\"return confirm('".__('Delete this poll?')."')\">";
      echo '<img src="' . PLUGINS_URI.'djg_poll/images/16_del.png' . '" alt="'.__('delete poll').'"></a>'.
			'</div>' .
		    '</td>'; 
		echo '</tr>';
	endforeach;
	else:
		echo '<tr><td colspan="4">' . __('No polls yet.') . '</td></tr>';
	endif;
?>	
	</tbody>
</table>
	<div class ="pagination">
		<?php
		echo __('Total: :count polls',array(':count' => $listCount));
		echo $pagination->createLinks();
		?>
	</div>
</div>