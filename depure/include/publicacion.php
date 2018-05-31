
<?php // require_once('..Connections/cae.php'); 
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
  $insertSQL = sprintf("INSERT INTO muro (turno1, turno2, solicitante, notas, area) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['turno1'], "date"),
                       GetSQLValueString($_POST['turno2'], "date"),
                       GetSQLValueString($_POST['solicitante'], "text"),
                       GetSQLValueString($_POST['notas'], "text"),
                       GetSQLValueString($_POST['area'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "murot.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cae, $cae);
$query_cmistunosmuro = "SELECT * FROM horarios WHERE login = '$session->username' ORDER BY dia DESC";
$cmistunosmuro = mysql_query($query_cmistunosmuro, $cae) or die(mysql_error());
$row_cmistunosmuro = mysql_fetch_assoc($cmistunosmuro);
$totalRows_cmistunosmuro = mysql_num_rows($cmistunosmuro);
?>



<div class="box_c">
    <div class="box_c_heading cf">
        <div class="box_c_ico"><img src="/img/ico/icSw2/16-List.png" alt="" /></div>
        <p>Buscar/Publicar Cambio de Turno</p>
    </div>
    <div class="row">
        <div class="twelve columns">
            <div class="form_content">
                <div class="formRow">
              		<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="nice">
              			<input type="hidden" name="MM_insert" value="form1" />
            			<label class="sepH_b">Turno a Cambiar:
            			<select name="turno1" data-placeholder="Seleccione el Turno a Cambiar&hellip;" class="chzn-select" style="width:300px;">
                    			<?php do { ?>
                        			<option value="<?php echo $row_cmistunosmuro['dia']; ?> <?php echo $row_cmistunosmuro['hentrada']; ?>"><?php echo $row_cmistunosmuro['dia']; ?> <?php echo $row_cmistunosmuro['hentrada']; ?></option>
                   				<?php } while ($row_cmistunosmuro = mysql_fetch_assoc($cmistunosmuro)); ?>
            			</select>
                        </label>
            			<label class="sepH_b">Hora a Solicitar
            			<input required type="time" class="input-text small" name="turno2" id="time">
                        </label>
                        <hr>
                        <label class="sepH_b">Notas / Comentario (Opcional)</label>
            			<?php include('/txtedit/textedit.php'); ?>
                			<textarea required="required" id="editor" name="notas"></textarea>
            			<?php include('/txtedit/texteditfoot.php'); ?>
              			<input type="hidden" name="solicitante" value="<?php echo $session->username ?>" size="32" />
                        <hr>
                  		<input type="submit" class="button small nice blue radius" value="Publicar">
                  		<input type="reset"  style="cursor:pointer;background-color:transparent; border:0;>" value="Limpiar" />
                  		<input required type="hidden" value="<?php echo $row_cinfoperfil['area']; ?>" name="area" />
                    </form>
              </div>
          </div>
      </div>
    </div>
</div>
    
                             
<?php
mysql_free_result($cmistunosmuro);
?>
