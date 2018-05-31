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
?>
<?php if ($totalRows_cmgss == 0) { // Show if recordset empty ?>
  <div class="box_c">
    <div class="box_c_heading cf">
      <p>Bandeja de Salida</p>
    </div>
    <div class="box_c_content">
      <h1>No tienes tickets...</h1>
    </div>
  </div>
  <?php } else {?>
<div class="box_c">
    <div class="box_c_heading cf">
        <p>Bandeja de Salida</p>
  </div>
    <div class="box_c_content">
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>ID</center></th>
                    <th><center>Para</center></th>
                    <th><center>Asunto</center></th>
                    <th><center>Fecha</center></th>
                    <th class="essential"><center>Ver</center></th>
                </tr>
            </thead>
            <tbody>
            <?php do { ?>
                <tr>
                    <td align="center"><a href="/message/view/<?php echo $row_cmgss['id']; ?>"><?php echo $row_cmgss['id']; ?></a></td>
                    <td><a href="/users/<?php echo $row_cmgss['destination']; ?>" class="small"><?php echo $row_cmgss['destination']; ?></a></td>
                    <td><a href="/message/view/<?php echo $row_cmgss['id']; ?>" class="small"><?php echo $row_cmgss['asunto']; ?></a></td>
                    <td><?php echo $row_cmgss['fcreation']; ?></td>
                    <td class="content_actions" align="center"><a href="/message/view/<?php echo $row_cmgss['id']; ?>" class="sepV_a" title="Ver Mensaje"><img src="/img/ico/preview_gray.png" alt="" /></a></td>
                </tr>
<?php } while ($row_cmgss = mysql_fetch_assoc($cmgss)); ?>
            </tbody>
        </table>
    </div>
</div>
<?php }  ?>



<?php
mysql_free_result($cmgss);
?>
