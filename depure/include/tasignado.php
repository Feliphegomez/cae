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

mysql_select_db($database_cae, $cae);
$query_backoffice = "SELECT * FROM backoffice WHERE backoffice.asignadoa = '$dirname'";
$backoffice = mysql_query($query_backoffice, $cae) or die(mysql_error());
$row_backoffice = mysql_fetch_assoc($backoffice);
$totalRows_backoffice = mysql_num_rows($backoffice);
?>


<div class="twelve columns">
    <div class="box_c">
        <div class="box_c_heading cf">
            <p>Trabajo Asignado</p>
        </div>
        <div class="box_c_content">
        <hr>
        <?php if ($totalRows_backoffice == 0) {  ?>
  <center><h3>No tienes Trabajo Asignado</h3></center>
  <?php } else { ?>
<?php do { 
          $sombra = $row_backoffice['ok']; ?>
          <form action="/back/cierre/" method="post" style="float: left; margin-left: 1%;">
          <input name="orden" type="hidden" value="<?php echo $row_backoffice['orden']; ?>" />
          <?php
            if (($sombra) == '1' ) {
                echo "<input value='ID: $row_backoffice[orden]' type='submit' style='box-shadow: 0 0 5px rgba(0,255,0,1);'"; }
            else { 
                echo "<input value='ID: $row_backoffice[orden]' type='submit' style='box-shadow: 0 0 5px rgba(255,0,0,1);'"; } ?>);">
          </form>
            <?php } while ($row_backoffice = mysql_fetch_assoc($backoffice)); } ?>
            <hr>
      </div>
</div>
                    
                    
                    
<?php mysql_free_result($backoffice);?>