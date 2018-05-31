<?php require_once('../Connections/cae.php'); ?>
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

if ((isset($_GET['userid'])) && ($_GET['userid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM users WHERE userid=%s",
                       GetSQLValueString($_GET['userid'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($deleteSQL, $cae) or die(mysql_error());

  $deleteGoTo = "/user/alls/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_cuserdels = "-1";
if (isset($_GET['userid'])) {
  $colname_cuserdels = $_GET['userid'];
}
mysql_select_db($database_cae, $cae);
$query_cuserdels = sprintf("SELECT * FROM users WHERE userid = %s", GetSQLValueString($colname_cuserdels, "text"));
$cuserdels = mysql_query($query_cuserdels, $cae) or die(mysql_error());
$row_cuserdels = mysql_fetch_assoc($cuserdels);
$totalRows_cuserdels = mysql_num_rows($cuserdels);

mysql_free_result($cuserdels);
?>
