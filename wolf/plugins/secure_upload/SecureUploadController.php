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

/**
 * Use this SkeletonController and this skeleton plugin as the basis for your
 * new plugins if you want.
 */

class SecureUploadController extends PluginController {

    public function __construct() {
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/secure_upload/views/sidebar'));
    }

    public function index() {
        $this->display('secure_upload/views/index');
    }

    public function upload() {
        require_once('/var/www/melchercms/config.php');

        $db = mysql_connect('localhost', DB_USER, DB_PASS);
        if($db) {
          mysql_select_db('binary_files', $db);

          $fileName = $_FILES['binFile']['name'];
          $fileType = $_FILES['binFile']['type'];
          $fileSize = $_FILES['binFile']['size'];
          $tempName = $_FILES['binFile']['tmp_name'];

          if($fileName != '') {
          
            $fp = fopen($tempName, 'r');
            $content = fread($fp, filesize($tempName));
            $content = addslashes($content);
            fclose($fp);
            $select_sql = "select filename from tbl_files where filename='$fileName'";
            $result = mysql_query($select_sql);
            $row = mysql_fetch_assoc($result);

            if($row == '') {
              $insert_sql = "insert into tbl_files (bin_data, filename, filesize, filetype)" .
                            "values ('$content', '$fileName', '$fileSize', '$fileType')";
              mysql_query($insert_sql) or Flash::setNow('error', __('Cannot insert to database'));
              $this->display('secure_upload/views/index');
            }
            else {
              Flash::setNow('error', __('Already have file with the same name'));
              $this->display('secure_upload/views/index');
            }
          }
          else {
            Flash::setNow('error', __('There is no file to upload'));
            $this->display('secure_upload/views/index');
          }  
        }
        mysql_close($db);
        
    }

    public function preview() {
      $file = func_get_args();
      $name = array_pop($file);

      require_once('/var/www/melchercms/config.php');

      $db = mysql_connect('localhost', DB_USER, DB_PASS);
      if($db) {
        mysql_select_db('binary_files', $db);
        $select_sql = "select * from tbl_files where filename = '$name'";
        $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot find file from database'));
        $name = mysql_result($result, 0, 'filename');
        $type = mysql_result($result, 0, 'filetype');
        header('Content-type:' . $type);
        echo mysql_result($result, 0, 'bin_data');
      }
      mysql_close($db);
    }

    public function delete() {
      $file = func_get_args();
      $name = array_pop($file);

      require_once('/var/www/melchercms/config.php');
    
      $db = mysql_connect('localhost', DB_USER, DB_PASS);
      if($db) {
        mysql_select_db('binary_files', $db);
        $delete_sql = "delete from tbl_files where filename='$name'";
        mysql_query($delete_sql) or Flash::setNow('error', __('Cannot delete file'));
      }
      mysql_close($db);

      redirect(get_url('plugin/secure_upload'));
    }

    public function download() {
      $file = func_get_args();
      $name = array_pop($file);
      
      require_once('/var/www/melchercms/config.php');
      
      $db = mysql_connect('localhost', DB_USER, DB_PASS);
      if($db) {
        mysql_select_db('binary_files', $db);
        $select_sql = "select * from tbl_files where filename='$name'";
        $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot download from database'));
        $name = mysql_result($result, 0, 'filename');
        $size = mysql_result($result, 0, 'filesize');
        $type = mysql_result($result, 0, 'filetype');

        header('Content-type:' . $type);
        header('Content-length;' . $size);
        header('Content-Disposition: attachment; filename=' . $name);
      }
      mysql_close($db);
    }

    function settings() {
        /** You can do this...
        $tmp = Plugin::getAllSettings('skeleton');
        $settings = array('my_setting1' => $tmp['setting1'],
                          'setting2' => $tmp['setting2'],
                          'a_setting3' => $tmp['setting3']
                         );
        $this->display('comment/views/settings', $settings);
         *
         * Or even this...
         */

        $this->display('secure_upload/views/settings', Plugin::getAllSettings('secure_upload'));
    }
}
