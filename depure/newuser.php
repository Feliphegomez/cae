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
	
	$pass4=md5($_POST['password']);
	$iduser4=md5($_POST['username']);
	$parent=$session->username;
	
  $insertSQL = sprintf("INSERT INTO users (username, password, userid, userlevel, email, `timestamp`, parent_directory, genere, `names`, area, tmovil, tfijo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($pass4, "text"),
                       GetSQLValueString($iduser4, "text"),
                       GetSQLValueString($_POST['userlevel'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['timestamp'], "int"),
                       GetSQLValueString($parent, "text"),
                       GetSQLValueString($_POST['genere'], "text"),
                       GetSQLValueString($_POST['names'], "text"),
                       GetSQLValueString($_POST['area'], "text"),
                       GetSQLValueString($_POST['tmovil'], "int"),
                       GetSQLValueString($_POST['tfijo'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/asigned/";
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
$query_careasagr = "SELECT * FROM skills ORDER BY name ASC";
$careasagr = mysql_query($query_careasagr, $cae) or die(mysql_error());
$row_careasagr = mysql_fetch_assoc($careasagr);
$totalRows_careasagr = mysql_num_rows($careasagr);
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
                <div class="row">
                <div class="twelve columns">
                    <div class="box_c">
                        <div class="box_c_heading cf">
                            <div class="box_c_ico"><img src="/img/ico/icSw2/16-List.png" alt="" /></div>
                            <p>Agregar Personal</p>
                        </div>
                        <div class="box_c_content form_a">
                            <?php 
				
				if(($row_cinfoperfil['userlevel']) == '1') { ?>
				<form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="validate nice custom">
                                <div class="formRow elVal">
                                    <label for="names">Nombre Completo</label>
                                    <input type="text" id="names" name="names" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="username">Usuario</label>
                                    <input type="text" id="username" name="username" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="input-text" />
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Cargo:</label>
                                            <select name="userlevel">
                                                <option value="2" <?php if (!(strcmp(2, 2))) {echo "SELECTED";} ?>>Agente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="tmovil">Telefono Movil:</label>
                                            <input type="number" id="tmovil" name="tmovil" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="tfijo">Telefono Fijo:</label>
                                            <input type="number" id="tfijo" name="tfijo" class="input-text medium" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="userlevel">Genero:</label>
                                            <ul class="block-grid three-up mobile">
                                                <li><input type="radio" name="genere" value="M" > Hombre</li>
                                                <li><input type="radio" name="genere" value="F" > Mujer</li>
                                            </ul>
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Area:</label>
                                            <select name="area">
                                                <?php do {  ?>
                                                <option value="<?php echo $row_careasagr['name']?>" ><?php echo $row_careasagr['name']?></option>
                                                <?php } while ($row_careasagr = mysql_fetch_assoc($careasagr)); ?>
                                            </select>     
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                	<input type="submit" class="button small pill black" value="Agregar Usuario">
                                    <input type="hidden" name="timestamp" value="<?php $cdate=time(); echo $cdate; ?>">
                                    <input type="hidden" name="parent_directory" value="<?php echo $cinfoperfil['username']; ?>">
                                    <input type="hidden" name="MM_insert" value="form1">
                                </div>
                            </form>
				<?php } elseif (($row_cinfoperfil['userlevel']) == '8') { ?>
                <form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="validate nice custom">
                                <div class="formRow elVal">
                                    <label for="names">Nombre Completo</label>
                                    <input type="text" id="names" name="names" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="username">Usuario</label>
                                    <input type="text" id="username" name="username" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="input-text" />
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Cargo:</label>
                                            <select name="userlevel">
                                                <option value="8" <?php if (!(strcmp(8, 2))) {echo "SELECTED";} ?>>Master</option>
                                                <option value="1" <?php if (!(strcmp(1, 2))) {echo "SELECTED";} ?>>Supervisor</option>
                                                <option value="2" <?php if (!(strcmp(2, 2))) {echo "SELECTED";} ?>>Agente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="tmovil">Telefono Movil:</label>
                                            <input type="number" id="tmovil" name="tmovil" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="tfijo">Telefono Fijo:</label>
                                            <input type="number" id="tfijo" name="tfijo" class="input-text medium" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="userlevel">Genero:</label>
                                            <ul class="block-grid three-up mobile">
                                                <li><input type="radio" name="genere" value="M" > Hombre</li>
                                                <li><input type="radio" name="genere" value="F" > Mujer</li>
                                            </ul>
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Area:</label>
                                            <select name="area">
                                                <?php do {  ?>
                                                <option value="<?php echo $row_careasagr['name']?>" ><?php echo $row_careasagr['name']?></option>
                                                <?php } while ($row_careasagr = mysql_fetch_assoc($careasagr)); ?>
                                            </select>     
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                	<input type="submit" class="button small pill black" value="Agregar Usuario">
                                    <input type="hidden" name="timestamp" value="<?php $cdate=time(); echo $cdate; ?>">
                                    <input type="hidden" name="parent_directory" value="<?php echo $cinfoperfil['username']; ?>">
                                    <input type="hidden" name="MM_insert" value="form1">
                                </div>
                            </form>
				<?php } elseif (($row_cinfoperfil['userlevel']) == '9') { ?>
                <form method="post" name="form1" action="<?php echo $editFormAction; ?>" class="validate nice custom">
                                <div class="formRow elVal">
                                    <label for="names">Nombre Completo</label>
                                    <input type="text" id="names" name="names" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="username">Usuario</label>
                                    <input type="text" id="username" name="username" class="input-text" />
                                </div>
                                <div class="formRow elVal">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="input-text" />
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Cargo:</label>
                                            <select name="userlevel">
                                                <option value="9" <?php if (!(strcmp(9, 2))) {echo "SELECTED";} ?>>Administrador</option>
                                                <option value="8" <?php if (!(strcmp(8, 2))) {echo "SELECTED";} ?>>Master</option>
                                                <option value="1" <?php if (!(strcmp(1, 2))) {echo "SELECTED";} ?>>Supervisor</option>
                                                <option value="2" <?php if (!(strcmp(2, 2))) {echo "SELECTED";} ?>>Agente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="tmovil">Telefono Movil:</label>
                                            <input type="number" id="tmovil" name="tmovil" class="input-text medium" />
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="tfijo">Telefono Fijo:</label>
                                            <input type="number" id="tfijo" name="tfijo" class="input-text medium" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                    <div class="row">
                                        <div class="six columns elVal">
                                            <label for="userlevel">Genero:</label>
                                            <ul class="block-grid three-up mobile">
                                                <li><input type="radio" name="genere" value="M" > Hombre</li>
                                                <li><input type="radio" name="genere" value="F" > Mujer</li>
                                            </ul>
                                        </div>
                                        <div class="six columns elVal">
                                            <label for="userlevel">Area:</label>
                                            <select name="area">
                                                <?php do {  ?>
                                                <option value="<?php echo $row_careasagr['name']?>" ><?php echo $row_careasagr['name']?></option>
                                                <?php } while ($row_careasagr = mysql_fetch_assoc($careasagr)); ?>
                                            </select>     
                                        </div>
                                    </div>
                                </div>
                                <div class="formRow">
                                	<input type="submit" class="button small pill black" value="Agregar Usuario">
                                    <input type="hidden" name="timestamp" value="<?php $cdate=time(); echo $cdate; ?>">
                                    <input type="hidden" name="parent_directory" value="<?php echo $cinfoperfil['username']; ?>">
                                    <input type="hidden" name="MM_insert" value="form1">
                                </div>
                            </form>
				<?php } else {} ?>
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
mysql_free_result($careasagr);
							 } else { header('Location: /index.php'); }  ?>
 
 
 
 
 
											
 
 