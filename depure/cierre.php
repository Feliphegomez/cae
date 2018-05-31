<?php include("include/classes/session.php"); ?>
<?php require_once('Connections/cae.php'); ?>
<?php

if (($_POST['orden']) == '') { header('Location: index.php'); } 
else {

$idcaso=$_POST['orden'];
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE backoffice SET cuenta=%s, asignadoa=%s, estado=%s, ok=%s, dato1=%s, dato2=%s, dato3=%s, dato4=%s WHERE orden=%s",
                       GetSQLValueString($_POST['cuenta'], "text"),
                       GetSQLValueString($_POST['asignadoa'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString(isset($_POST['ok']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['dato1'], "text"),
                       GetSQLValueString($_POST['dato2'], "text"),
                       GetSQLValueString($_POST['dato3'], "text"),
                       GetSQLValueString($_POST['dato4'], "text"),
                       GetSQLValueString($_POST['orden'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($updateSQL, $cae) or die(mysql_error());

  $updateGoTo = "/backoffice/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


mysql_select_db($database_cae, $cae);
$query_backoffice = "SELECT * FROM backoffice WHERE backoffice.orden = '$idcaso'";
$backoffice = mysql_query($query_backoffice, $cae) or die(mysql_error());
$row_backoffice = mysql_fetch_assoc($backoffice);
$totalRows_backoffice = mysql_num_rows($backoffice);

mysql_select_db($database_cae, $cae);
$query_cest = "SELECT * FROM estados";
$cest = mysql_query($query_cest, $cae) or die(mysql_error());
$row_cest = mysql_fetch_assoc($cest);
$totalRows_cest = mysql_num_rows($cest);

mysql_select_db($database_cae, $cae);
$query_cres = "SELECT * FROM resultados";
$cres = mysql_query($query_cres, $cae) or die(mysql_error());
$row_cres = mysql_fetch_assoc($cres);
$totalRows_cres = mysql_num_rows($cres);

$var_username_cinfoperfil = "-1";
if (isset($session->username)) {
  $var_username_cinfoperfil = $session->username;
}
mysql_select_db($database_cae, $cae);
$query_cinfoperfil = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($var_username_cinfoperfil, "text"));
$cinfoperfil = mysql_query($query_cinfoperfil, $cae) or die(mysql_error());
$row_cinfoperfil = mysql_fetch_assoc($cinfoperfil);
$totalRows_cinfoperfil = mysql_num_rows($cinfoperfil);

?>

<?php if (($session->logged_in)){ 	?>

<!DOCTYPE html>
<html lang="es">
<?php include('include/head.php'); ?>
	<body class="ptrn_a grdnt_a mhover_a">
		<?php include('include/header.php') ?>
        <div class="container">
            <div class="row">
                <div class="twelve columns">
                    <div class="box_c">
                        <div class="box_c_heading cf">
                            <p><?php echo "<label>Cierre para Orden: </label>".$idcaso ?></p>
                        </div>
                        <div class="box_c_content">
                        <table width="100%" border="1">
  <tr>
    <td><?php echo "<label>Cierre para Orden: </label>".$idcaso ?></td>
    <td><label>Cuenta: </label><label><?php echo $row_backoffice['cuenta']; ?></label></td>
  </tr>
  <tr>
    <td><label>Asignado a: </label><label><?php echo $row_backoffice['asignadoa']; ?></label></td>
    <td><label>Estado Actual: </label><label><?php echo $row_backoffice['estado']; ?></label></td>
  </tr>
  <tr>
    <td><label>Primer Dato: </label><label><?php echo $row_backoffice['dato1']; ?></label></td>
    <td><label>Segundo Dato: </label><label><?php echo $row_backoffice['dato2']; ?></label></td>
  </tr>
</table>
<hr>

<?php
if (($row_backoffice['ok']) == '1') { 

?>

<form style="text-align: center;" method="post" name="form1" action="<?php echo $editFormAction; ?>">
<label>Estado: </label>
<label><b><?php echo $row_backoffice['estado']; ?></b></label> | 
<label>Resultado: </label>
<label><b><?php echo $row_backoffice['dato3']; ?></b></label><br>
<label>Notas: </label>
<textarea name="dato4" cols="8" style="width:100%;"><?php echo $row_backoffice['dato4']; ?></textarea>
<label><font color="#006600" size="+2">¡Gestion Finalizada!</font><input type="hidden" name="ok" value="1"></label>


<input type="hidden" name="orden" value="<?php echo $row_backoffice['orden']; ?>">
<input type="hidden" name="cuenta" value="<?php echo htmlentities($row_backoffice['cuenta'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="asignadoa" value="<?php echo htmlentities($row_backoffice['asignadoa'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="dato1" value="<?php echo htmlentities($row_backoffice['dato1'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="dato2" value="<?php echo htmlentities($row_backoffice['dato2'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="dato3" value="<?php echo htmlentities($row_backoffice['dato2'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="estado" value="<?php echo htmlentities($row_backoffice['dato2'], ENT_COMPAT, 'utf-8'); ?>">

<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="orden" value="<?php echo $row_backoffice['orden']; ?>">
<hr>
<input type="submit" value="Agregar Notas a Visita">
</form>





<?php 
} else { ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<label>Estado: </label>
  <select name="estado">
	<option style="background-color: #ccc;" value="<?php echo $row_backoffice['estado']; ?>"><?php echo $row_backoffice['estado']; ?></option>
<?php do { ?>
    <option value="<?php echo $row_cest['estado']; ?>"><?php echo $row_cest['estado']; ?></option>
  <?php } while ($row_cest = mysql_fetch_assoc($cest)); ?>
  </select>
<label>Resultado: </label>
  <select name="dato3">
<?php do { ?>
    <option value="<?php echo $row_cres['etiqueta']; ?>"><?php echo $row_cres['etiqueta']; ?></option>
  <?php } while ($row_cres = mysql_fetch_assoc($cres)); ?>
  </select>
<label>Notas: </label>
<textarea name="dato4" cols="8" style="width:100%;"><?php echo htmlentities($row_backoffice['dato4'], ENT_COMPAT, 'utf-8'); ?></textarea>
<label>¿Finalizar Gestion? <input type="checkbox" name="ok" value=""  <?php if (!(strcmp(htmlentities($row_backoffice['ok'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>></label>


<input type="hidden" name="orden" value="<?php echo $row_backoffice['orden']; ?>">
<input type="hidden" name="cuenta" value="<?php echo htmlentities($row_backoffice['cuenta'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="asignadoa" value="<?php echo htmlentities($row_backoffice['asignadoa'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="dato1" value="<?php echo htmlentities($row_backoffice['dato1'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="dato2" value="<?php echo htmlentities($row_backoffice['dato2'], ENT_COMPAT, 'utf-8'); ?>">
<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="orden" value="<?php echo $row_backoffice['orden']; ?>">
<hr>
<input type="submit" value="Cerrar Trabajo / Guardar Notas">
</form>
                            
                             <?php }

?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php include('include/footer.php'); ?>
		<?php include('include/scripts-f.php'); ?>
	</body>
</html>


<?php 
mysql_free_result($backoffice);

mysql_free_result($cest);

mysql_free_result($cres); } else { header('Location: index.php'); }  
}
?>
