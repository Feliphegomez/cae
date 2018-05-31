<?php include("include/classes/session.php"); ?>
<?php require_once('Connections/cae.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


$var_username_cinfoperfil = "-1";
if (isset($session->username)) {
  $var_username_cinfoperfil = $session->username;
}
mysql_select_db($database_cae, $cae);
$query_cinfoperfil = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($var_username_cinfoperfil, "text"));
$cinfoperfil = mysql_query($query_cinfoperfil, $cae) or die(mysql_error());
$row_cinfoperfil = mysql_fetch_assoc($cinfoperfil);
$totalRows_cinfoperfil = mysql_num_rows($cinfoperfil);


$cinfoperfil=$row_cinfoperfil['username'];

mysql_select_db($database_cae, $cae);
$query_cmigrupo = "SELECT * FROM users WHERE parent_directory = '$cinfoperfil'";
$cmigrupo = mysql_query($query_cmigrupo, $cae) or die(mysql_error());
$row_cmigrupo = mysql_fetch_assoc($cmigrupo);
$totalRows_cmigrupo = mysql_num_rows($cmigrupo);




?>
<?php if (($session->logged_in)){ 	?>

<!DOCTYPE html>
<html lang="es">
<?php include('include/head.php'); ?>
	<body class="ptrn_a grdnt_a mhover_a">
		<?php include('include/header.php') ?>
        <div class="container">
		  <div class="row">
                <div class="twelve columns">
                    <?php include('include/mygroup.php'); ?>
				</div>
            </div>
		</div>
		<?php include('include/footer.php'); ?>
		<?php include('include/scripts-f.php'); ?>
	</body>
</html>




<?php

mysql_free_result($cmigrupo);

 } else { header('Location: index.php'); }  ?>