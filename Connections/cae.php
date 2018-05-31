<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cae = "localhost";
$database_cae = "cae";
$username_cae = "root";
$password_cae = "";
$cae = mysql_pconnect($hostname_cae, $username_cae, $password_cae) or trigger_error(mysql_error(),E_USER_ERROR); 
?>