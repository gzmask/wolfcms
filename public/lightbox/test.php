<?php
$order = $_POST["orders"];
for($i = 0; $i < 8; $i++)
{
  $order[$i] = 2;
}
echo $order;
?>