




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
$query_cmgs = "SELECT * FROM tickets WHERE id = '$_GET[message]'";
$cmgs = mysql_query($query_cmgs, $cae) or die(mysql_error());
$row_cmgs = mysql_fetch_assoc($cmgs);
$totalRows_cmgs = mysql_num_rows($cmgs);

ini_set('date.timezone','America/Bogota'); 
$date = date("Y-m-d H:i");
?>
<div class="box_c">
    <div class="box_c_heading cf">
        <p>Visor de Mensajes</p>
  </div>
  
<?php if(($row_cmgs['destination']) == $session->username) { ?>

<?php if(($row_cmgs['visto']) == 0) { 

  $updateSQL = sprintf("UPDATE tickets SET fview='$date', visto='1' WHERE id='$_GET[message]'");

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($updateSQL, $cae) or die(mysql_error());

  $updateGoTo = "/message/view/$_GET[message]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

 else { ?>

    <div class="box_c_content">
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>Fecha de Envio:</center></th>
                    <td class="essential"><center><?php echo $row_cmgs['fcreation']; ?></center></td>
                    <th class="essential"><center>De:</center></th>
                    <td class="essential"><center><a href="/users/<?php echo $row_cmgs['create']; ?>/" ><?php echo $row_cmgs['create']; ?></a></center></td>
                </tr>
                <tr>
                    <th class="essential" colspan="4"><center>Asunto:</center></th>
                </tr>
                <tr>
                    <td class="essential" colspan="4"><center><?php echo $row_cmgs['asunto']; ?></center></td>
                </tr>
                <tr>
                	<th class="essential" colspan="4"><?php echo $row_cmgs['mgs']; ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <form style="float:right;" method="post" action="/newticket/">
        <input type="hidden" value="<?php echo $row_cmgs['create']; ?>" name="destination" />
        <input type="hidden" value="RE: <?php echo $row_cmgs['asunto']; ?>" name="asunto" />
        <input type="hidden" value="<?php echo "<hr /><br>".$row_cmgs['mgs']; ?>" name="mgs" />
        <input type="hidden" value="<?php echo $session->username; ?>" name="create" />
        <input class="button red small radius nice" type="submit" value="Responder" />
        </form>
        <hr />
    </div>
    
<?php }  ?>

    
    
    
</div>



<?php } elseif(($row_cmgs['create']) == $session->username) { ?>

    <div class="box_c_content">
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>Fecha de Envio:</center></th>
                    <td class="essential"><center><?php echo $row_cmgs['fcreation']; ?></center></td>
                    <th class="essential"><center>De:</center></th>
                    <td class="essential"><center><a href="/users/<?php echo $row_cmgs['create']; ?>/" ><?php echo $row_cmgs['create']; ?></a></center></td>
                </tr>
                <tr>
                    <th class="essential" colspan="4"><center>Asunto:</center></th>
                </tr>
                <tr>
                    <td class="essential" colspan="4"><center><?php echo $row_cmgs['asunto']; ?></center></td>
                </tr>
                <tr>
                	<th class="essential" colspan="4"><?php echo $row_cmgs['mgs']; ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <hr />
    </div>
    
<?php  } else { header('Location: /inbox/');
mysql_free_result($cmgs);  } 
?>
