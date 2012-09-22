<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * The skeleton plugin serves as a basic plugin template.
 *
 * This skeleton plugin makes use/provides the following features:
 * - A controller without a tab
 * - Three views (sidebar, documentation and settings)
 * - A documentation page
 * - A sidebar
 * - A settings page (that does nothing except display some text)
 * - Code that gets run when the plugin is enabled (enable.php)
 *
 * Note: to use the settings and documentation pages, you will first need to enable
 * the plugin!
 *
 * @package Plugins
 * @subpackage skeleton
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @copyright Martijn van der Kleijn, 2008
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */
?>
<h1><?php echo __('Secure Upload'); ?></h1>
<!--<form method="post" action="<?php echo get_url('plugin/secure_upload/upload'); ?>" enctype="multipart/form-data">
  <input type="hidden" name="max_file_size" value="16000000" />
  <input type="file" name="binFile" />
  <input type="submit" value="Upload" />
</form>-->
<table id="files-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <th class="files"><?php echo __('File'); ?></th>
    <th class="size"><?php echo __('Size'); ?></th>
    <th class="modify"><?php echo __('Modify'); ?></th>
  </tr>
  <?php
    require_once('/var/www/melchercms/config.php');
    $db = mysql_connect('localhost', DB_USER, DB_PASS);
    if($db) {
      mysql_select_db('binary_files', $db);
      $sql = "select * from tbl_files where 1";
      $result = mysql_query($sql);
      while($row = mysql_fetch_assoc($result)) {
?>
      <tr>
        <td><a href="<?php echo get_url('plugin/secure_upload/download/'.$row['filename']); ?>"><?php echo $row['filename']; ?></a></td>
        <td><code><?php echo $row['filesize']; ?></code></td>
        <td><a href="<?php echo get_url('plugin/secure_upload/preview/'. $row['filename']); ?>"><img src="<?php echo ICONS_URI;?>delete-16.png" alt="<?php echo __('delete file icon'); ?>" title="<?php echo __('Preview file'); ?>" /></a></td>
        <td><a href="<?php echo get_url('plugin/secure_upload/delete/'. $row['filename']); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete?'); ?> <?php echo $row['filename']; ?>?');"><img src="<?php echo ICONS_URI;?>delete-16.png" alt="<?php echo __('delete file icon'); ?>" title="<?php echo __('Delete file'); ?>" /></a></td>
      </tr>
<?php
    }
  }
?>
</table>

<div id="boxes">
  <div id="upload-file-popup" class="window">
    <div class="titlebar">
      <?php echo __('Upload file'); ?>
      <a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
    </div>
    <div class="content">
      <form method="post" action="<?php echo get_url('plugin/secure_upload/upload'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="max_file_size" value="16000000" />
        <input type="file" name="binFile" />
        <input type="submit" value="Upload" />
      </form>
    </div>
  </div>
</div>
