<?php
function lightbox_display(){;
          require_once(CMS_ROOT . DS . 'config.php');

          $db = mysql_connect('localhost', DB_USER, DB_PASS);
          if($db) {
            mysql_select_db('gallery', $db);
            $select_sql = 'select * from image_order where 1';
            $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot select from database'));
            $num_rows = mysql_num_rows($result);

            for($curr = 1; $curr <= $num_rows; $curr++) {
              $select_sql = 'select * from image_order where order_number = ' . $curr;
              $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot select from database'));
              $image = mysql_result($result, 0, 'image_name');
              $thumbnail = mysql_result($result, 0, 'thumbnail_name');
              $order = mysql_result($result, 0, 'order_number');
              $image_path = URL_PUBLIC . 'public/gallery/' . $image;
              $thumbnail_path = URL_PUBLIC . 'public/gallery/thumbnails/' . $thumbnail;
            
              echo "<a href='$image_path' rel='lightbox[image]' title='$image'><img src='$thumbnail_path' />";
            }
          }
          mysql_close($db);

}
?>

