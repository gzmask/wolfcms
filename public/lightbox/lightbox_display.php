<?php
function lightbox_display(){
	  require_once(CMS_ROOT . DS . 'config.php');

          $db = mysql_connect('localhost', DB_USER, DB_PASS);
          if($db) {
            mysql_select_db('gallery', $db);
            $select_sql = 'select * from image_order where 1';
            $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot select from database'));
            $num_rows = mysql_num_rows($result);

            for($curr = 1; $curr <= $num_rows; $curr++) 
	    {
              $select_sql = 'select * from image_order where order_number = ' . $curr;
              $result = mysql_query($select_sql) or Flash::setNow('error', __('Cannot select from database'));
              $image = mysql_result($result, 0, 'image_name')
              $thumbnail = mysql_result($result, 0, 'thumbnail_name');
              $rollover = mysql_result($result, 0, 'rollover_name')
	      $order = mysql_result($result, 0, 'order_number')
              $image_path = URL_PUBLIC . 'public/gallery/' . $image
              $thumbnail_path = URL_PUBLIC . 'public/gallery/thumbnails/' . $thumbnail;
              $rollover_path = URL_PUBLIC . 'public/gallery/rollovers/' . $rollover;

	      echo "<script src='js/jquery-1.7.2.min.js'></script>";
              echo "<a class='image$curr' href='$image_path' rel='lightbox[image]' title='$image'><img src='$thumbnail_path' />";
	      if($rollover != '')
	      {	
	      	echo "<script>
			$('.image$curr').hover(
				function() {
					$('.image$curr img').attr('src', '$rollover_path');
				},
				function() {
					$('.image$curr img').attr('src', '$thumbnail_path');
				}
			);
		    </script>";
	      }
	    }
          }
          mysql_close($db);
}
?>
