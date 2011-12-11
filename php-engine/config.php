<?php
$con = mysql_connect("$host","$user","$pw");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("$db", $con);
?> 