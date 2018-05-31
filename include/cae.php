<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cae = "mysql2.000webhost.com";
$database_cae = "a7272865_cae";
$username_cae = "a7272865_caeuser";
$password_cae = "Pa55w0rd.";
$cae = mysql_pconnect($hostname_cae, $username_cae, $password_cae) or trigger_error(mysql_error(),E_USER_ERROR); 
?>