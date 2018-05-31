<?php include("include/classes/session.php"); ?>
<?php require_once('Connections/cae.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO backoffice (orden, cuenta, asignadoa, estado, dato1, dato2) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['orden'], "int"),
                       GetSQLValueString($_POST['cuenta'], "int"),
                       GetSQLValueString($_POST['asignadoa'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['dato1'], "text"),
                       GetSQLValueString($_POST['dato2'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "asigback.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO backoffice (orden, cuenta, asignadoa, estado, dato1, dato2) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['orden'], "int"),
                       GetSQLValueString($_POST['cuenta'], "int"),
                       GetSQLValueString($_POST['asignadoa'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['dato1'], "text"),
                       GetSQLValueString($_POST['dato2'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/job/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO backoffice (orden, cuenta, asignadoa, estado, dato1, dato2, dato4) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['orden'], "int"),
                       GetSQLValueString($_POST['cuenta'], "int"),
                       GetSQLValueString($_POST['asignadoa'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['dato1'], "text"),
                       GetSQLValueString($_POST['dato2'], "text"),
                       GetSQLValueString($_POST['dato4'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/job/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}





$var_username_cinfoperfil = "-1";
if (isset($session->username)) {
  $var_username_cinfoperfil = $session->username;
}
mysql_select_db($database_cae, $cae);
$query_cinfoperfil = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($var_username_cinfoperfil, "text"));
$cinfoperfil = mysql_query($query_cinfoperfil, $cae) or die(mysql_error());
$row_cinfoperfil = mysql_fetch_assoc($cinfoperfil);
$totalRows_cinfoperfil = mysql_num_rows($cinfoperfil);

mysql_select_db($database_cae, $cae);
$query_backoffice = "SELECT * FROM backoffice";
$backoffice = mysql_query($query_backoffice, $cae) or die(mysql_error());
$row_backoffice = mysql_fetch_assoc($backoffice);
$totalRows_backoffice = mysql_num_rows($backoffice);

mysql_select_db($database_cae, $cae);
$query_names = "SELECT * FROM users";
$names = mysql_query($query_names, $cae) or die(mysql_error());
$row_names = mysql_fetch_assoc($names);
$totalRows_names = mysql_num_rows($names);

mysql_select_db($database_cae, $cae);
$query_cestados = "SELECT * FROM estados";
$cestados = mysql_query($query_cestados, $cae) or die(mysql_error());
$row_cestados = mysql_fetch_assoc($cestados);
$totalRows_cestados = mysql_num_rows($cestados);
?>



<?php if (($session->logged_in)){ 	?>

<!DOCTYPE html>
<html lang="es">
<?php include('include/head.php'); ?>
	<body class="ptrn_a grdnt_a mhover_a">
    	<?php include('include/header.php') ?>
        <div class="container">
			<div class="row">
				<div class="three columns hide-on-phones">
					<?php include('include/panelmenu.php'); ?>
				</div>
				<div class="nine columns">
               <div class="box_c">
                    <div class="box_c_heading cf">
                        <div class="box_c_ico"><img src="/img/ico/icSw2/16-Abacus.png" alt="" /></div><p>Estadisticas</p></div>
                        <div class="box_c_content">Hola!, Solo te recordamos que tienes dos opciones de asignar trabajo, de manera manual o descargando el documento "<a href="/templates/backoffice/">plantilla</a>" e importando los datos.<br>
                          <br>
                          <?php
                          
						  $asiga = $_POST['asiga'];
						  
						  if (($asiga) == '') { header('Location: index.php'); } else { 
						  
						   ?>
                           <label>Asignar Trabajo a:&nbsp;<?php echo $asiga ?></label>
                           <hr>
                           <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                             <table align="center">
                               <tr valign="baseline">
                                 <td nowrap align="right">Orden:</td>
                                 <td><input type="text" name="orden" value="" size="32"></td>
                               </tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">Cuenta:</td>
                                 <td><input type="text" name="cuenta" value="" size="32"></td>
                               </tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">Estado:</td>
                                 <td><select name="estado">
                                   <?php 
do {  
?>
                                   <option value="<?php echo $row_cestados['estado']?>" ><?php echo $row_cestados['estado']?></option>
                                   <?php
} while ($row_cestados = mysql_fetch_assoc($cestados));
?>
                                 </select></td>
                               <tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">Dato 1:</td>
                                 <td><input type="text" name="dato1" value="" size="32"></td>
                               </tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">Dato 2:</td>
                                 <td><input type="text" name="dato2" value="" size="32"></td>
                               </tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">Notas:<br></td>
                                 <td><textarea name="dato4"></textarea></td>
                               </tr>
                               <tr valign="baseline">
                                 <td nowrap align="right">&nbsp;</td>
                                 <td><input type="submit" value="Insertar registro"></td>
                               </tr>
                             </table>
                             <input type="hidden" name="asignadoa" value="<?php echo $asiga ?>">
                             <input type="hidden" name="MM_insert" value="form1">
                           </form>
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

mysql_free_result($names);

mysql_free_result($cestados);
						  } } else { header('Location: /index.php'); }  ?>
 
 
 
 
 
											
 
 