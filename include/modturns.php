
<div class="box_c">
	<div class="box_c_heading cf">
        <p>Confirmacion de Modificacion de Horarios</p>
    </div>
    <div class="box_c_content">
        <div class="row">
            <div class="twelve columns">
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
$query_ctunsmods = "SELECT * FROM horarios WHERE horarios.login = '$_POST[login]' AND horarios.dia = '$_POST[dia]'";
$ctunsmods = mysql_query($query_ctunsmods, $cae) or die(mysql_error());
$row_ctunsmods = mysql_fetch_assoc($ctunsmods);
$totalRows_ctunsmods = mysql_num_rows($ctunsmods);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE horarios SET login=%s, dia=%s, skill=%s, hentrada=%s, hbreak1=%s, halmuerzo=%s, hbreak2=%s, hsalida=%s, createby=%s, modby=%s WHERE id=%s",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['dia'], "date"),
                       GetSQLValueString($_POST['skill'], "text"),
                       GetSQLValueString($_POST['hentrada_new'], "int"),
                       GetSQLValueString($_POST['hbreak1_new'], "int"),
                       GetSQLValueString($_POST['halmuerzo_new'], "int"),
                       GetSQLValueString($_POST['hbreak2_new'], "int"),
                       GetSQLValueString($_POST['hsalida'], "int"),
                       GetSQLValueString($_POST['createby'], "text"),
                       GetSQLValueString($_POST['modby'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($updateSQL, $cae) or die(mysql_error());
  
  
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO temp_turnos (login, modby, dia, hentrada_new, hentrada_ant, hsalida_new, hsalida_ant, hbreak1_new, hbreak1_ant, hbreak2_new, hbreak2_ant, halmuerzo_new, halmuerzo_ant, `view`, dmod, hmod, skill, createby) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['modby'], "text"),
                       GetSQLValueString($_POST['dia'], "date"),
                       GetSQLValueString($_POST['hentrada_new'], "text"),
                       GetSQLValueString($_POST['hentrada_ant'], "text"),
                       GetSQLValueString($_POST['hsalida_new'], "text"),
                       GetSQLValueString($_POST['hsalida_ant'], "text"),
                       GetSQLValueString($_POST['hbreak1_new'], "text"),
                       GetSQLValueString($_POST['hbreak1_ant'], "text"),
                       GetSQLValueString($_POST['hbreak2_new'], "text"),
                       GetSQLValueString($_POST['hbreak2_ant'], "text"),
                       GetSQLValueString($_POST['halmuerzo_new'], "text"),
                       GetSQLValueString($_POST['halmuerzo_ant'], "text"),
                       GetSQLValueString(0, "text"),
                       GetSQLValueString($_POST['dmod'], "date"),
                       GetSQLValueString($_POST['hmod'], "text"),
                       GetSQLValueString($_POST['skill'], "text"),
                       GetSQLValueString($_POST['createby'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());
  

  $insertGoTo = "/turnos/mod/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
  

  $updateGoTo = "/calendars/$_POST[login]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


?>
<?php  //* echo $_POST['login']." | ";echo $_POST['dia']." | ";echo $_POST['hentrada_new']." | ";echo $_POST['hsalida_new']." | ";echo $_POST['hbreak1']." | ";echo $_POST['halmuerzo']." | ";echo $_POST['hbreak2']." | ";echo $_POST['modby']." | ";echo $_POST['createby']." | ";echo $_POST['dmod']." | ";echo $_POST['hmod']." | ";echo $_POST['dia']." | ";echo $_POST['skill']." | ";echo $_POST['hentrada_ant']." | ";echo $_POST['hsalida_ant']." | ";echo $_POST['hbreak1_ant']." | ";echo $_POST['halmuerzo_ant']." | ";echo $_POST['hbreak2_ant']." | <br><br>"; *//
	?>	
    
    
    <center><h3>Confirmacion de Modificacion</h3></center>
    <p align="center">Vas a modificar el turno de: <?php echo $_POST['login']; ?> para el dia: <?php echo $_POST['dia']; ?>, estas seguro que deseas continuar.?
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <input name="login" type="hidden" value="<?php echo $_POST['login']; ?>" />
    <input name="dia" type="hidden" value="<?php echo $_POST['dia']; ?>" />
    <input name="hentrada_new" type="hidden" value="<?php echo $_POST['hentrada_new']; ?>" />
    <input name="hsalida_new" type="hidden" value="<?php echo $_POST['hsalida_new']; ?>" />
    <input name="hbreak1_new" type="hidden" value="<?php echo $_POST['hbreak1']; ?>" />
    <input name="halmuerzo_new" type="hidden" value="<?php echo $_POST['halmuerzo']; ?>" />
    <input name="hbreak2_new" type="hidden" value="<?php echo $_POST['hbreak2']; ?>" />
    <input name="modby" type="hidden" value="<?php echo $_POST['modby']; ?>" />
    <input name="createby" type="hidden" value="<?php echo $_POST['createby']; ?>" />
    <input name="dmod" type="hidden" value="<?php echo $_POST['dmod']; ?>" />
    <input name="hmod" type="hidden" value="<?php echo $_POST['hmod']; ?>" />
    <input name="dia" type="hidden" value="<?php echo $_POST['dia']; ?>" />
    <input name="skill" type="hidden" value="<?php echo $_POST['skill']; ?>" />
    <input name="hentrada_ant" type="hidden" value="<?php echo $_POST['hentrada_ant']; ?>" />
    <input name="hsalida_ant" type="hidden" value="<?php echo $_POST['hsalida_ant']; ?>" />
    <input name="hbreak1_ant" type="hidden" value="<?php echo $_POST['hbreak1_ant']; ?>" />
    <input name="halmuerzo_ant" type="hidden" value="<?php echo $_POST['halmuerzo_ant']; ?>" />
    <input name="hbreak2_ant" type="hidden" value="<?php echo $_POST['hbreak2_ant']; ?>" /> 
<hr>
<center><input type="submit" class="button green radius nice" value="Confirmar" /></center>

<input type="hidden" name="MM_insert" value="form1">
<input type="hidden" name="MM_update" value="form2">
</form>






<?php
mysql_free_result($ctunsmods);
?>

            </div>
        </div>
    </div>
</div>