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
$query_cmurosp = "SELECT * FROM muro WHERE area = '$row_cinfoperfil[area]'";
$cmurosp = mysql_query($query_cmurosp, $cae) or die(mysql_error());
$row_cmurosp = mysql_fetch_assoc($cmurosp);
$totalRows_cmurosp = mysql_num_rows($cmurosp);
?>


<?php if ($totalRows_cmurosp == 0) { ?>
    <div class="box_c">
        <div class="box_c_heading cf">
            <div class="box_c_ico"><img src="/img/ico/icSw2/16-List.png" alt="" /></div>
        </div>
        <div class="box_c_content form_a">
            <div class="formRow">
                <div class="row">
                    <div class="twelve columns">
                        <p><b>Lo sentimos,</b> No hay publicacion disponibles...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>



<div class="row">
    <div class="twelve columns">
                <?php do { ?>
        <div class="box_c">
            <div class="box_c_heading cf">
                <div class="box_c_ico"><img src="/img/ico/icSw2/16-List.png" alt="" /></div>
                <p>Solicitado Por: <b><?php echo $row_cmurosp['solicitante']; ?></b></p>
            </div>
            <div class="box_c_content">
                    <form action="" method="post" class="nice">
                        <p><b><?php echo $row_cmurosp['solicitante']; ?></b>, Desea cambiar el turno del dia [<?php echo $row_cmurosp['turno1']; ?>] en el area [<?php echo $row_cmurosp['area']; ?>] por la hora [<?php echo $row_cmurosp['turno2']; ?>]...</p>
                        <?php echo $row_cmurosp['notas']; ?>
                        <input type="hidden" value="<?php echo $row_cmurosp['area']; ?>" name="area" />
                    </form>
            </div>
        </div>
    <br>
                <?php } while ($row_cmurosp = mysql_fetch_assoc($cmurosp)); ?>
    </div>
</div>
            

    
<?php } ?>


<?php 
    mysql_free_result($cmurosp); 
    ?>
