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
$query_cgroupmsg = "SELECT * FROM users ORDER BY `names` ASC";
$cgroupmsg = mysql_query($query_cgroupmsg, $cae) or die(mysql_error());
$row_cgroupmsg = mysql_fetch_assoc($cgroupmsg);
$totalRows_cgroupmsg = mysql_num_rows($cgroupmsg);

mysql_select_db($database_cae, $cae);
$query_cskillsnewas = "SELECT * FROM skills ORDER BY `name` ASC";
$cskillsnewas = mysql_query($query_cskillsnewas, $cae) or die(mysql_error());
$row_cskillsnewas = mysql_fetch_assoc($cskillsnewas);
$totalRows_cskillsnewas = mysql_num_rows($cskillsnewas);



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO horarios (login, dia, skill, hentrada, hbreak1, halmuerzo, hbreak2, hsalida, createby) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['dia'], "date"),
                       GetSQLValueString($_POST['skill'], "text"),
                       GetSQLValueString($_POST['hentrada'], "text"),
                       GetSQLValueString($_POST['hbreak1'], "text"),
                       GetSQLValueString($_POST['halmuerzo'], "text"),
                       GetSQLValueString($_POST['hbreak2'], "text"),
                       GetSQLValueString($_POST['hsalida'], "text"),
                       GetSQLValueString($_POST['createby'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/calendars/$_POST[login]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$time = time();
$date = date("Y-m-d H:i:s");
?>

<div class="box_c">
	<div class="box_c_heading cf">
        <p>Asignar Horarios</p>
    </div>
    <div class="box_c_content">
        <div class="row">
            <div class="twelve columns">
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" style="text-align:center;">
                <label>Asignar a:
                    <input list="browsers" type="text" id="login" class="input-text oversize" name="login" value="" size="32" style="border-radius: 10px; width: 100%;" />
                    <datalist id="browsers">
						<?php do { ?>
                            <option value="<?php echo $row_cgroupmsg['username']; ?>"></option>
                        <?php } while ($row_cgroupmsg = mysql_fetch_assoc($cgroupmsg)); ?>
                    </datalist>
                </label>
                <label>Despacho:
                    <input list="skills" type="text" id="skill" class="input-text oversize" name="skill" value="" size="32" style="border-radius: 10px; width: 100%;" />
                    <datalist id="skills">
						<?php do { ?>
                            <option value="<?php echo $row_cskillsnewas['name']; ?>"></option>
                        <?php } while ($row_cskillsnewas = mysql_fetch_assoc($cskillsnewas)); ?>
                    </datalist>
                </label>
                <hr />
                <label>Día:
                    <input required="required" type="date" id="dia" class="input-text oversize" name="dia" value="" size="32" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <label>Hora Entrada:
                    <input required="required" type="text" id="hentrada" class="input-text oversize" name="hentrada" value="" maxlength="5" size="5" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <label>Hora Salida:
                    <input required="required" type="text" id="hsalida" class="input-text oversize" name="hsalida" value="" maxlength="5" size="5" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <br />
                <label>Hora Break 1:
                    <input required="required" type="text" id="hbreak1" class="input-text oversize" name="hbreak1" value="" maxlength="5" size="5" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <label>Hora Almuerzo:
                    <input required="required" type="text" id="halmuerzo" class="input-text oversize" name="halmuerzo" maxlength="5" value="" size="5" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <label>Hora Break 2:
                    <input required="required" type="text" id="hbreak2" class="input-text oversize" name="hbreak2" maxlength="5" value="" size="5" style="border-radius: 10px; width: 100%; text-align:center;" />
                </label>
                <hr />
                <input style="float:right; margin-right: 35px; margin-top:20px" class="button blue radius nice" type="submit" value="Enviar Mensaje" />
                <input type="hidden" name="MM_insert" value="form1" />
                <input type="hidden" name="createby" value="<?php echo $session->username ?>" />
              </form>
            </div>
        </div>
    </div>
</div>
<?php
mysql_free_result($cgroupmsg);
?>
