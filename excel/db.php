<?php
define("HOSTADDRESS","localhost");
define("DBACCOUNT","admin_qrcode");
define("DBPASSWORD","TBp3DS5S");
define("DBNAME","admin_qrcode");

$con=mysql_connect(HOSTADDRESS,DBACCOUNT,DBPASSWORD);
mysql_query("set names 'utf8'"); 
mysql_select_db(DBNAME,$con);
?>