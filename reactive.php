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
$query_ctback = "SELECT * FROM backoffice";
$ctback = mysql_query($query_ctback, $cae) or die(mysql_error());
$row_ctback = mysql_fetch_assoc($ctback);
$totalRows_ctback = mysql_num_rows($ctback);

mysql_select_db($database_cae, $cae);
$query_cback = "SELECT * FROM backoffice WHERE backoffice.asignadoa = '$session->username'";
$cback = mysql_query($query_cback, $cae) or die(mysql_error());
$row_cback = mysql_fetch_assoc($cback);
$totalRows_cback = mysql_num_rows($cback);

mysql_select_db($database_cae, $cae);
$query_ctbackok = "SELECT * FROM backoffice WHERE backoffice.ok = '1'";
$ctbackok = mysql_query($query_ctbackok, $cae) or die(mysql_error());
$row_ctbackok = mysql_fetch_assoc($ctbackok);
$totalRows_ctbackok = mysql_num_rows($ctbackok);

mysql_select_db($database_cae, $cae);
$query_ctusers = "SELECT * FROM users";
$ctusers = mysql_query($query_ctusers, $cae) or die(mysql_error());
$row_ctusers = mysql_fetch_assoc($ctusers);
$totalRows_ctusers = mysql_num_rows($ctusers);

$filtro=$row_cinfoperfil['parent_directory'];

mysql_select_db($database_cae, $cae);
$query_cgrupomsgnew = "SELECT * FROM users WHERE parent_directory = '$filtro'";
$cgrupomsgnew = mysql_query($query_cgrupomsgnew, $cae) or die(mysql_error());
$row_cgrupomsgnew = mysql_fetch_assoc($cgrupomsgnew);
$totalRows_cgrupomsgnew = mysql_num_rows($cgrupomsgnew);


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
                        <div class="box_c_heading cf ">
                            <p>Reactivar Trabajo Finalizado</p>
                        </div>
                        <div class="box_c_content">
                        
                        <?php
                        if (!empty($_POST['orden'])) { ?>
						
<?php

$idcaso = $_POST['orden'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE backoffice SET cuenta=%s, asignadoa=%s, estado=%s, ok=%s, dato1=%s, dato2=%s, dato3=%s, dato4=%s WHERE orden=%s",
                       GetSQLValueString($_POST['cuenta'], "int"),
                       GetSQLValueString($_POST['asignadoa'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['ok'], "int"),
                       GetSQLValueString($_POST['dato1'], "text"),
                       GetSQLValueString($_POST['dato2'], "text"),
                       GetSQLValueString($_POST['dato3'], "text"),
                       GetSQLValueString($_POST['dato4'], "text"),
                       GetSQLValueString($_POST['orden'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($updateSQL, $cae) or die(mysql_error());

  $updateGoTo = "/reactivate/";
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


echo 
	"<center><h4>Estas seguro que deseas Re-Activar el Trabajo ".$idcaso."?.</h4></center>"."<hr>"."<p align='center'>Recuerda que una esta opcion solo es utilizable en algunos casos y quedara registro de toda tu actividad.</p><hr>";

 ?>

<form method="post" name="form2" action="<?php echo $editFormAction; ?>" style="text-align:center;"><input type="submit" class="button radius green nice" value="Reactivar">
  <input type="hidden" name="orden" value="<?php echo $row_backoffice['orden']; ?>">
  <input type="hidden" name="cuenta" value="<?php echo htmlentities($row_backoffice['cuenta'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="asignadoa" value="<?php echo htmlentities($row_backoffice['asignadoa'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="estado" value="<?php echo htmlentities($row_backoffice['estado'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="ok" value="0">
  <input type="hidden" name="dato1" value="<?php echo htmlentities($row_backoffice['dato1'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="dato2" value="<?php echo htmlentities($row_backoffice['dato2'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="dato3" value="<?php echo htmlentities($row_backoffice['dato3'], ENT_COMPAT, ''); ?>">
  <input type="hidden" name="dato4" value="<?php echo "// Reactivada Por: ".$session->username." // $row_backoffice[dato4]"; ?>">
  <input type="hidden" name="MM_update" value="form2">
</form>
						<?php } else { ?>
                            <form method="post" name="formulario" action="" style="text-align:center;">
                                <label for="orden">Numero de la Orden:</label>
                                <input type="number" id="orden" required value="" name="orden" />
                                <br />
                          		<input class="gh_button medium pill" type="submit" value="Ir..." />
                          	</form>
                            
                            <?php } ?>
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
mysql_free_result($cinfoperfil);

mysql_free_result($ctback);

mysql_free_result($ctbackok);

mysql_free_result($ctusers);

mysql_free_result($cgrupomsgnew);
							 } else { header('Location: /index.php'); }  ?>
 
 
 
 
 
											
 
 