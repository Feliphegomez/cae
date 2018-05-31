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
$query_cmgs = "SELECT * FROM tickets WHERE destination = '$session->username'";
$cmgs = mysql_query($query_cmgs, $cae) or die(mysql_error());
$row_cmgs = mysql_fetch_assoc($cmgs);
$totalRows_cmgs = mysql_num_rows($cmgs);
?>
<?php if ($totalRows_cmgs == 0) { // Show if recordset empty ?>
  <div class="box_c">
    <div class="box_c_heading cf">
      <p>Bandeja de Entrada</p>
      </div>
    <div class="box_c_content">
      <h1>No tienes tickets...</h1>
      </div>
  </div>
  <?php } else {?>
<div class="box_c">
    <div class="box_c_heading cf">
        <p>Bandeja de Entrada</p>
  </div>
    <div class="box_c_content">
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>ID</center></th>
                    <th><center>De</center></th>
                    <th><center>Asunto</center></th>
                    <th><center>Fecha</center></th>
                    <th><center>Ver</center></th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
                <tr>
                    <td align="center">
                    <a href="/message/view/<?php echo $row_cmgs['id']; ?>"><?php echo $row_cmgs['id']; ?></a>
                    </td>
                    <td>
                    <a href="/users/<?php echo $row_cmgs['create']; ?>" class="small"><?php echo $row_cmgs['create']; ?></a></td>
                    <td>
                    <a href="/message/view/<?php echo $row_cmgs['id']; ?>" class="small"><?php echo $row_cmgs['asunto']; ?></a></td>
                    <td><?php echo $row_cmgs['fcreation']; ?></td>
                    <td class="content_actions" align="center">
                    <a href="/message/view/<?php echo $row_cmgs['id']; ?>" class="sepV_a" title="Ver Mensaje"><img src="/img/ico/preview_gray.png"/></a>
                    </td>
                </tr>
			<?php } while ($row_cmgs = mysql_fetch_assoc($cmgs)); ?>
            </tbody>
        </table>
    </div>
</div>
<?php }  ?>



<?php
mysql_free_result($cmgs);
?>
