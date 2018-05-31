<?php include("include/classes/session.php"); ?>
<?php require_once('Connections/cae.php'); ?>
<?php
$dirname=$session->username;
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

$maxRows_vhor = 10;
$pageNum_vhor = 0;
if (isset($_GET['pageNum_vhor'])) {
  $pageNum_vhor = $_GET['pageNum_vhor'];
}
$startRow_vhor = $pageNum_vhor * $maxRows_vhor;

mysql_select_db($database_cae, $cae);
$query_vhor = "SELECT * FROM horarios WHERE horarios.login = '$dirname' ORDER BY horarios.dia";
$query_limit_vhor = sprintf("%s LIMIT %d, %d", $query_vhor, $startRow_vhor, $maxRows_vhor);
$vhor = mysql_query($query_limit_vhor, $cae) or die(mysql_error());
$row_vhor = mysql_fetch_assoc($vhor);

if (isset($_GET['totalRows_vhor'])) {
  $totalRows_vhor = $_GET['totalRows_vhor'];
} else {
  $all_vhor = mysql_query($query_vhor);
  $totalRows_vhor = mysql_num_rows($all_vhor);
}
$totalPages_vhor = ceil($totalRows_vhor/$maxRows_vhor)-1;


?>
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


$cinfoperfil=$row_cinfoperfil['parent_directory'];

mysql_select_db($database_cae, $cae);
$query_cmigrupo = "SELECT * FROM users WHERE parent_directory = '$cinfoperfil'";
$cmigrupo = mysql_query($query_cmigrupo, $cae) or die(mysql_error());
$row_cmigrupo = mysql_fetch_assoc($cmigrupo);
$totalRows_cmigrupo = mysql_num_rows($cmigrupo);



$cinfoarea=$row_cinfoperfil['area'];

mysql_select_db($database_cae, $cae);
$query_cmiarea = "SELECT * FROM users WHERE area = '$cinfoarea'";
$cmiarea = mysql_query($query_cmiarea, $cae) or die(mysql_error());
$row_cmiarea = mysql_fetch_assoc($cmiarea);
$totalRows_cmiarea = mysql_num_rows($cmiarea);

?><?php if (($session->logged_in)){ 	?>

<!DOCTYPE html>
<html lang="es">
<?php include('include/head.php'); ?>
	<body class="ptrn_a grdnt_a mhover_a">
		<?php include('include/header.php') ?>
        <div class="container">
            <div class="row">
                    <?php include('include/misturnos.php'); ?>
            </div>
        </div>
		<?php include('include/footer.php'); ?>
		<?php include('include/scripts-f.php'); ?>
	</body>
</html>




<?php

mysql_free_result($cmigrupo);

mysql_free_result($vhor);

 } else { header('Location: /index.php'); }  ?>