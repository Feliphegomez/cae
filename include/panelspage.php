<?php // require_once('..Connections/cae.php'); ?>
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

mysql_select_db($database_cae, $cae);
$query_cmgss = "SELECT * FROM tickets WHERE `create` = '$session->username'";
$cmgss = mysql_query($query_cmgss, $cae) or die(mysql_error());
$row_cmgss = mysql_fetch_assoc($cmgss);
$totalRows_cmgss = mysql_num_rows($cmgss);

mysql_select_db($database_cae, $cae);
$query_cpersonalpnl = "SELECT * FROM users WHERE parent_directory = '$session->username'";
$cpersonalpnl = mysql_query($query_cpersonalpnl, $cae) or die(mysql_error());
$row_cpersonalpnl = mysql_fetch_assoc($cpersonalpnl);
$totalRows_cpersonalpnl = mysql_num_rows($cpersonalpnl);
?>

<div class="box_c">
    <div class="box_c_heading cf">
        <p>Panel de Jefes</p>
  </div>
  <div class="box_c_content">
    <div class="listNav" id="contactList-nav"></div>
        <p class="inner_heading sepH_b cf">Mi Personal</p>
        <ul id="contactList" class="numbered content_list">
            <?php do { ?>
            <li><a href="/users/<?php echo $row_cpersonalpnl['username']; ?>" style="text-transform:capitalize;"><?php echo $row_cpersonalpnl['names']; ?></a><span class="right small s_color"><?php echo $row_cpersonalpnl['username']; ?></span></li>
              <?php } while ($row_cpersonalpnl = mysql_fetch_assoc($cpersonalpnl)); ?>
        </ul>
  </div>
</div>

<?php
mysql_free_result($cmgss);

mysql_free_result($cpersonalpnl);
?>
