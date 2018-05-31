
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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM estados WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($deleteSQL, $cae) or die(mysql_error());

  $deleteGoTo = "/widgets/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_carea = "-1";
if (isset($_GET['id'])) {
  $colname_carea = $_GET['id'];
}
mysql_select_db($database_cae, $cae);
$query_carea = sprintf("SELECT * FROM estados WHERE id = %s", GetSQLValueString($colname_carea, "int"));
$carea = mysql_query($query_carea, $cae) or die(mysql_error());
$row_carea = mysql_fetch_assoc($carea);
$totalRows_carea = mysql_num_rows($carea);

echo "Eliminando... &gt; "." $row_carea[name] - ID: $row_carea[id]";

mysql_free_result($carea);
?>