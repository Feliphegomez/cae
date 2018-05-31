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


mysql_select_db($database_cae, $cae);
$query_callsusers = "SELECT * FROM users";
$callsusers = mysql_query($query_callsusers, $cae) or die(mysql_error());
$row_callsusers = mysql_fetch_assoc($callsusers);
$totalRows_callsusers = mysql_num_rows($callsusers);
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
                
                <?php if (($session->userlevel) == '9'){ ?>
                
                
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>Login</center></th>
                    <th><center>Nombres</center></th>
                    <th><center>Area</center></th>
                    <th><center>Eliminar</center></th>
                </tr>
            </thead>
            <tbody>
              <?php do { ?>
  <tr>
    <td align="center"><a href="/users/<?php echo $row_callsusers['username']; ?>"><?php echo $row_callsusers['username']; ?></a></td>
    <td><?php echo $row_callsusers['names']; ?></td>
    <td><?php echo $row_callsusers['area']; ?></td>
    <td><a href="/delete/users/<?php echo $row_callsusers['userid']; ?>/">Eliminar</a></td>
  </tr>
  <?php } while ($row_callsusers = mysql_fetch_assoc($callsusers)); ?>
            </tbody>
        </table>
				
				<?php } else { header('Location: /login/'); } ?>
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
 
 
 
 
 
											
 
 