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
$query_cuseractives = "SELECT * FROM active_users";
$cuseractives = mysql_query($query_cuseractives, $cae) or die(mysql_error());
$row_cuseractives = mysql_fetch_assoc($cuseractives);
$totalRows_cuseractives = mysql_num_rows($cuseractives);


?>


            <div class="row">
                <div class="twelve columns">
<div class="box_c">
    <div class="box_c_heading cf">
        <p>(Personal Conectado)</p>
  </div>
    <div class="box_c_content">
        <table class="display dt_act mobile_dt3" id="content_table">
            <thead>
                <tr>
                    <th class="essential"><center>Login</center></th>
                    <th><center>Nombres</center></th>
                    <th><center>Area</center></th>
                </tr>
            </thead>
            <tbody>
              <?php do { 
mysql_select_db($database_cae, $cae);
$query_cusersalls = "SELECT * FROM users WHERE username = '$row_cuseractives[username]' ORDER BY username DESC";
$cusersalls = mysql_query($query_cusersalls, $cae) or die(mysql_error());
$row_cusersalls = mysql_fetch_assoc($cusersalls);
$totalRows_cusersalls = mysql_num_rows($cusersalls); 
?>
  <tr>
    <td align="center"><a href="/users/<?php echo $row_cusersalls['username']; ?>"><?php echo $row_cusersalls['username']; ?></a></td>
    <td><?php echo $row_cusersalls['names']; ?></td>
    <td><?php echo $row_cusersalls['area']; ?></td>
  </tr>
  <?php } while ($row_cuseractives = mysql_fetch_assoc($cuseractives)); ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php
mysql_free_result($cusersalls);

mysql_free_result($cuseractives);
?>











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
?>



<?php if (($session->logged_in)){ 	?>

            <div class="row">
                <div class="twelve columns">
                    <div class="box_c">
                        <div class="box_c_heading cf ">
                            <p>Asignar Trabajo a Empleados</p>
                        </div>
                        <div class="box_c_content">
                          <form method="post" name="formulario" action="/jobs/">
                          <label>Asignar Trabajo a:&nbsp;
                          <select size="5" style="width: 250px;" name="asiga">
							  <?php do { ?>
                                <option value="<?php echo $row_names['username']; ?>"><?php echo $row_names['username']; ?></option>
                                <?php } while ($row_names = mysql_fetch_assoc($names)); ?>
                          </select>

                          </label>
<br />
                            <input class="button radius blue nice" type="submit" value="Ir..." />
                          </form>
                      </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
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
$query_backoffice = "SELECT * FROM backoffice";
$backoffice = mysql_query($query_backoffice, $cae) or die(mysql_error());
$row_backoffice = mysql_fetch_assoc($backoffice);
$totalRows_backoffice = mysql_num_rows($backoffice);

mysql_select_db($database_cae, $cae);
$query_names = "SELECT * FROM users";
$names = mysql_query($query_names, $cae) or die(mysql_error());
$row_names = mysql_fetch_assoc($names);
$totalRows_names = mysql_num_rows($names);
?>


                         
            <div class="row">
                <div class="six columns">
                    <div class="box_c">
                        <form action="/export/backoffice/">
                        <div class="box_c_heading cf">
                            <p>Exportar Archivo de Trabajo</p>
                        </div>
                        <div class="box_c_content">
                        	<label>Exportar Archivo de BackOffice en un documento de Excel</label>
                            <input name="tabla" value="backoffice" type="hidden" />
                            <button type="submit" class="button black nice radius" style="width:100%;">Generar</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="six columns">
                    <div class="box_c">
                        <div class="box_c_heading cf">
                            <p>Importar Archivo CSV</p>
                            
                        </div><form action='/import/backoffice/' method='post' enctype="multipart/form-data">
                        <div class="box_c_content sw_resizedEL">
                             
  <label>Descarga el archivo "<a href="/templates/plantilla.csv">plantilla</a>" e importando tus datos de manera rapida y facil.</label>
   <label>Importar Archivo: </label>
   <input type="file" class="button white nice radius" name='sel_file' style="width: 280px; padding-left: 5px;">
   <hr />
   <input type='submit' class="button black nice radius" name='submit' style="width:100%;" value='Importar Archivo'>
  
                        </div>
                        </form>
                    </div>
                </div>
                <div class="six columns">
                    <div class="box_c">
                            <form action="/clearbackoffice/">
                        <div class="box_c_heading cf">
                            <p>Limpiar BackOffice (Limpiar Ordenes)</p>
                        </div>
                        <div class="box_c_content">
                            <label>Ojo!, Vas a borrar Toda la informacion del backoffice.</label>
                                <button class="button black nice radius" type="submit" style="width:100%;">Limpiar</button>
                        </div>
                            </form>
                    </div>
            	</div>
</div>


            
<?php } else { header('Location: index.php'); }  

mysql_free_result($backoffice);

mysql_free_result($names);
?>





