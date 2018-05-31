
<?php if (($session->logged_in)){ 	

ini_set('date.timezone','America/Bogota'); 
$time = date("Hi");
$date = date("Y-m-d");

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE temp_turnos SET login=%s, dview=%s, hview=%s, `view`=%s WHERE id=%s",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['dview'], "date"),
                       GetSQLValueString($_POST['hview'], "text"),
                       GetSQLValueString($_POST['view'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($updateSQL, $cae) or die(mysql_error());

  $updateGoTo = "/view/turns/$_POST[login]/$row_cback[dia]/$row_cback[id]/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


?>



				<div class="twelve columns">

<div class="box_c">
						<div class="box_c_heading cf">
							<div class="box_c_ico"><img src="/img/ico/icSw2/16-Graph.png" alt="" /></div><p>Notificacion de Cambio de Turno</p>
						</div>
						<div class="box_c_content">
                        <center><h3>Notificacion de modificacion de horarios</h3></center>
                        <hr />
                        <p>Sistema Automatico CAE, le informa que su turno del día <b><?php echo $row_cback['dia']; ?></b> a Cambiado al continuar se comprende que queda enterado de la modificacion de su horario y asistira sin problemas a su jornada laboral.</p>
                        <hr />
                        	<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                                <input type="hidden" name="login" value="<?php echo htmlentities($row_cback['login'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                                <input type="hidden" name="dview" value="<?php echo $date; ?>" size="32">
                                <input type="hidden" name="hview" value="<?php echo $time; ?>" size="32">
                                <input type="hidden" name="view" value="1" size="32">
                                <center><input type="submit" class="button green radius nice" value="Continuar"></center>
                                <input type="hidden" name="MM_update" value="form1">
                                <input type="hidden" name="id" value="<?php echo $row_cback['id']; ?>">
                            </form>
						</div>
					</div>

<?php } ?>