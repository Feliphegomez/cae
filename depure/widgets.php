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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO skills (name, id) VALUES (%s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/widgets/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO estados (estado) VALUES (%s)",
                       GetSQLValueString($_POST['estado'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/widgets/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO resultados (etiqueta) VALUES (%s)",
                       GetSQLValueString($_POST['etiqueta'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/widgets/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

mysql_select_db($database_cae, $cae);
$query_careasfull = "SELECT * FROM skills";
$careasfull = mysql_query($query_careasfull, $cae) or die(mysql_error());
$row_careasfull = mysql_fetch_assoc($careasfull);
$totalRows_careasfull = mysql_num_rows($careasfull);

mysql_select_db($database_cae, $cae);
$query_cresultadosfull = "SELECT * FROM resultados";
$cresultadosfull = mysql_query($query_cresultadosfull, $cae) or die(mysql_error());
$row_cresultadosfull = mysql_fetch_assoc($cresultadosfull);
$totalRows_cresultadosfull = mysql_num_rows($cresultadosfull);

mysql_select_db($database_cae, $cae);
$query_cestadosfull = "SELECT * FROM estados";
$cestadosfull = mysql_query($query_cestadosfull, $cae) or die(mysql_error());
$row_cestadosfull = mysql_fetch_assoc($cestadosfull);
$totalRows_cestadosfull = mysql_num_rows($cestadosfull);
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
                        <div class="six columns">
                            <div class="box_c">
                                <div class="box_c_heading cf ">
                                    <p>Areas Trabajo Finalizado</p>
                                </div>
                                <div class="box_c_content">
                                	<table class="display mobile_dt1 dt_act" >
                                        <th>Nombre</th>
                                        <th>ID</th>
                                        <th>Eliminar</th>
											<?php do { ?>
                                        <tr>
                                        	<td><?php echo $row_careasfull['name']; ?></td>
                                            <td><?php echo $row_careasfull['id']; ?></td>
                                          <td align="center"><a href="/delete/widgets/area/<?php echo $row_careasfull['id']; ?>"><img src="/img/ico/trashcan_gray.png" width="15" height="15"></a></td>
                                        </tr>
                                            <?php } while ($row_careasfull = mysql_fetch_assoc($careasfull)); ?>
                                    </table>
                                    <hr>
                                    <p>Si deseas agregar una area de trabajo nueva puedes utilizar el siguiente formulario.</p>
                                    <form method="post" name="form1" action="<?php echo $editFormAction; ?>" style="text-align:center;">
                                        <input type="number" placeholder="ID" name="id" value="" style="width: 50px;">
                                        <input placeholder="Nombre" type="text" name="name" value="" style="width: auto;">
                                        <hr>
                                        <input type="submit" value="Agregar Nueva Area" class="button green radius nice">
                                        <input type="hidden" name="MM_insert" value="form1">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="six columns">
                            <div class="box_c">
                                <div class="box_c_heading cf ">
                                    <p>Estados</p>
                                </div>
                                <div class="box_c_content">
                                	<table class="display mobile_dt1 dt_act" >
                                        <th>Nombre</th>
                                        <th>ID</th>
                                        <th>Eliminar</th>
											<?php do { ?>
                                        <tr>
                                        	<td><?php echo $row_cestadosfull['estado']; ?></td>
                                            <td><?php echo $row_cestadosfull['id']; ?></td>
                                          <td align="center"><a href="/delete/widgets/status/<?php echo $row_cestadosfull['id']; ?>"><img src="/img/ico/trashcan_gray.png" width="15" height="15"></a></td>
                                        </tr>
                                            <?php } while ($row_cestadosfull = mysql_fetch_assoc($cestadosfull)); ?>
                                    </table>
                                    <hr>
                                  <p>Si deseas agregar un estado de ordenes nuevo puedes utilizar el siguiente formulario.</p>
                                  <form method="post" name="form2" action="<?php echo $editFormAction; ?>" style="text-align:center;">
                                  	  <input placeholder="Estado" type="text" name="estado" value="" size="32">
                                      <hr>
                                      <input type="submit" value="Agregar Nuevo Estado" class="button green radius nice">
                                      <input type="hidden" name="MM_insert" value="form2">
                                  </form>
                                </div>
                            </div>
                        </div>
                        <div class="six columns">
                            <div class="box_c">
                                <div class="box_c_heading cf ">
                                    <p>Cierres Finales</p>
                                </div>
                              <div class="box_c_content">
                                	<table class="display mobile_dt1 dt_act" >
                                        <th>Nombre</th>
                                        <th>ID</th>
                                        <th>Eliminar</th>
											<?php do { ?>
                                        <tr>
                                        	<td><?php echo $row_cresultadosfull['etiqueta']; ?></td>
                                            <td><?php echo $row_cresultadosfull['id']; ?></td>
                                          <td align="center"><a href="/delete/widgets/gotokback/<?php echo $row_cresultadosfull['id']; ?>"><img src="/img/ico/trashcan_gray.png" width="15" height="15"></a></td>
                                        </tr>
                                            <?php } while ($row_cresultadosfull = mysql_fetch_assoc($cresultadosfull)); ?>
                                    </table>
                                    <hr>
                                <p>Si deseas agregar un cierre de ordenes nuevo puedes utilizar el siguiente formulario.</p>
                                <form method="post" name="form3" action="<?php echo $editFormAction; ?>" style="text-align:center;">
                                	<input placeholder="Cierre" type="text" name="etiqueta" value="" size="32">
                                	<hr>
                                	<input type="submit" value="Agregar Nuevo Cierre" class="button green radius nice">
                                	<input type="hidden" name="MM_insert" value="form3">
                                </form>
                              </div>
                            </div>
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
 
 
 
 
 
											
 
 