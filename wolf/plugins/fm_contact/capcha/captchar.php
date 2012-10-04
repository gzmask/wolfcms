<?php 
/*  
 * @package Plugins
 * fm_contact - A contact form pulgin for Wolf CMS for HTML 
 * Copyright (C) 2012 Fredy Mettler <homepage@hotmail.ch> 
 * @author Fredy Mettler <homepage@hotmail.ch> 
 *  Version 1.0.0  
 */
   session_start(); 
   unset($_SESSION['captcha_spam']); 

   function randomString($len) { 
      function make_seed(){ 
         list($usec , $sec) = explode (' ', microtime()); 
         return (float) $sec + ((float) $usec * 100000); 
      } 
      srand(make_seed());  
      //Der String $possible enthält alle Zeichen, die verwendet werden sollen 
      $possible="ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789"; 
      $str=""; 
      while(strlen($str)<$len) { 
        $str.=substr($possible,(rand()%(strlen($possible))),1); 
      } 
   return($str); 
   } 

   $text = randomString(5);  //Die Zahl bestimmt die Anzahl stellen 
   $_SESSION['captcha_spam'] = $text; 
   
//   $img = ImageCreateFromPNG('captcha.PNG'); //Backgroundimage 
   $img = imagecreatetruecolor(140, 40);
   $color = ImageColorAllocate($img, 255, 255, 255); //Farbe 
//   $ttf = 'XFILES.TTF'; //Schriftart  
   $ttf = './Arial.ttf';
   $ttfsize = 25; //Schriftgrösse 
   $angle = rand(0,5); 
   $t_x = rand(3,30); 
   $t_y = 35; 

    imagettftext($img, $ttfsize, $angle, $t_x, $t_y, $color, $ttf, $text);
//    ImageTTFText($img, $ttfsize, $angle, $t_x, $t_y, $color, $ttf, "2a3b4");
    header('Content-Type: image/jpeg');
    imagejpeg($img);
    imagedestroy($img);
?> 
