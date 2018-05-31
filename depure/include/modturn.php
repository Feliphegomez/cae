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

ini_set('date.timezone','America/Bogota'); 
$time = date("Hi");
$date = date("Y-m-d");
?>

<div class="box_c">
	<div class="box_c_heading cf">
        <p>Modificar Horarios</p>
    </div>
    <div class="box_c_content">
        <div class="row">
            <div class="twelve columns">
            <?php
			
            if (!empty($_GET['fg'])) {
				
					mysql_select_db($database_cae, $cae);
$query_cdiasact = "SELECT * FROM horarios WHERE login = '$_GET[fg]'";
$cdiasact = mysql_query($query_cdiasact, $cae) or die(mysql_error());
$row_cdiasact = mysql_fetch_assoc($cdiasact);
$totalRows_cdiasact = mysql_num_rows($cdiasact);

				
				
				if (!empty($_GET['date'])) { 
				
									mysql_select_db($database_cae, $cae);
$query_cdiasactw = "SELECT * FROM horarios WHERE login = '$_GET[fg]' AND dia = '$_GET[date]'";
$cdiasactw = mysql_query($query_cdiasactw, $cae) or die(mysql_error());
$row_cdiasactw = mysql_fetch_assoc($cdiasactw);
$totalRows_cdiasactw = mysql_num_rows($cdiasactw);

				
				?>
                
                
                <form method="post" id="modturns" name="modturns" action="/modturns/confirm/">
            <label for="login" style="width: 80%; float:left;">
                <font style="padding: 5px;" size="+1" >Usuario: <?php echo $row_cdiasactw['login']; ?></font>
            </label>
            <input type="hidden" class="input-text oversize" name="login" value="<?php echo $row_cdiasactw['login']; ?>" size="35" style="border-radius: 10px; width: 80%;float:left; width: 60%;" />
            <hr />
            
			<label for="dia" style="width: 80%; float:left;">
                <font style="padding: 5px;" size="+1" >Día: <?php echo $row_cdiasactw['dia']; ?></font>
            </label>
            <input type="hidden" class="input-text oversize" name="dia" value="<?php echo $row_cdiasactw['dia']; ?>" size="10" style="border-radius: 10px; width: 80%;float:left; width: 60%;" />
            <hr />
            
            <label for="hentrada" style="width: 25%; float:left;">
                <font style="padding: 5px;" size="+1" >Hora de Entrada: </font>
            </label>
            <input type="text" maxlength="5" class="input-text oversize" name="hentrada_new" value="<?php echo $row_cdiasactw['hentrada']; ?>"  style="border-radius: 10px; float:left; width: 10%;" />
            <hr />
            
            <label for="hsalida" style="width: 25%; float:left;">
                <font style="padding: 5px;" size="+1" >Hora de Salida: </font>
            </label>
            <input type="text" maxlength="5" class="input-text oversize" name="hsalida_new" value="<?php echo $row_cdiasactw['hsalida']; ?>"  style="border-radius: 10px; float:left; width: 10%;" />
            <hr />
            
            <label for="hbreak1" style="width: 25%; float:left;">
                <font style="padding: 5px;" size="+1" >Hora Break 1: </font>
            </label>
            <input type="text" maxlength="5" class="input-text oversize" name="hbreak1" value="<?php echo $row_cdiasactw['hbreak1']; ?>"  style="border-radius: 10px; float:left; width: 10%;" />
            <hr />
            
            <label for="halmuerzo" style="width: 25%; float:left;">
                <font style="padding: 5px;" size="+1" >Hora de Almuerzo: </font>
            </label>
            <input type="text" maxlength="5" class="input-text oversize" name="halmuerzo" value="<?php echo $row_cdiasactw['halmuerzo']; ?>"  style="border-radius: 10px; float:left; width: 10%;" />
            <hr />
            
            <label for="hbreak2" style="width: 25%; float:left;">
                <font style="padding: 5px;" size="+1" >Hora Break 2: </font>
            </label>
            <input type="text" maxlength="5" class="input-text oversize" name="hbreak2" value="<?php echo $row_cdiasactw['hbreak2']; ?>"  style="border-radius: 10px; float:left; width: 10%;" />
            <hr />
            <input type="submit" class="button black small radius nice" value="Guardar Horario" />
            <input type="hidden" name="modby" value="<?php echo $session->username; ?>" />
            <input type="hidden" name="createby" value="<?php echo $row_cdiasactw['createby']; ?>" />
            <input type="hidden" name="dmod" value="<?php echo $date; ?>" />
            <input type="hidden" name="hmod" value="<?php echo $time; ?>" />
            <input type="hidden" name="dia" value="<?php echo $row_cdiasactw['dia']; ?>" />
            <input type="hidden" name="skill" value="<?php echo $row_cdiasactw['skill']; ?>" />
            <input type="hidden" name="hentrada_ant" value="<?php echo $row_cdiasactw['hentrada']; ?>" />
            <input type="hidden" name="hsalida_ant" value="<?php echo $row_cdiasactw['hsalida']; ?>" />
            <input type="hidden" name="hbreak1_ant" value="<?php echo $row_cdiasactw['hbreak1']; ?>" />
            <input type="hidden" name="halmuerzo_ant" value="<?php echo $row_cdiasactw['halmuerzo']; ?>" />
            <input type="hidden" name="hbreak2_ant" value="<?php echo $row_cdiasactw['hbreak2']; ?>" />
            
            </form>
					
				
			<?php } else { 
			
			?>
            
            
            
            
            
            <form method="get" id="date" name="date">
            <label for="Usuario" style="width: 80%; float:left;">
                <font style="padding: 5px;" size="+1" >Usuario: <?php echo $_GET['fg']; ?></font>
            </label>
            <input type="hidden" class="input-text oversize" name="fg" value="<?php echo $_GET['fg']; ?>" size="35" style="border-radius: 10px; width: 80%;float:left; width: 60%;" />
            <hr />
			<label for="Dia" style="width: 75px; float:left;">
                <font style="padding: 5px;" size="+1" >Día:&nbsp;</font>
            </label>
            <input list="dia" type="date" id="Usuario" class="input-text oversize" name="date" value="" size="10" style="border-radius: 10px; width: 80%;float:left; width: 60%;" />
            <datalist id="dia">
                <?php do { ?>
                    <option value="<?php echo $row_cdiasact['dia']; ?>"></option>
                <?php } while ($row_cdiasact = mysql_fetch_assoc($cdiasact)); ?>
            </datalist>
            &nbsp;
            <input type="submit" class="button black small radius nice" value="Cargar Dia" />
            </form>
			<?php }
			?>
            
            
            
            
            
            
				
				
			<?php } else { ?>
            <form method="get" id="user" name="user">
			<label for="Usuario" style="width: 75px; float:left;">
                <font style="padding: 5px;" size="+1" >Usuario:&nbsp;</font>
            </label>
            <input list="browsers" type="text" id="Usuario" class="input-text oversize" name="fg" value="" size="10" style="border-radius: 10px; width: 80%;float:left; width: 60%;" />
            <datalist id="browsers">
                <?php do { ?>
                    <option value="<?php echo $row_cgroupmsg['username']; ?>"></option>
                <?php } while ($row_cgroupmsg = mysql_fetch_assoc($cgroupmsg)); ?>
            </datalist>
            &nbsp;
            <input type="submit" class="button black small radius nice" value="Cargar Horarios" />
            </form>
			<?php }
			?>
            </div>
        </div>
    </div>
</div>
<?php
mysql_free_result($cgroupmsg);
?>
