
<?php if (($session->logged_in)){ 	

ini_set('date.timezone','America/Bogota'); 
$time = date("Hi");
$date = date("Y-m-d");

if (($row_cback['view']) == 0) { header('Location: /index.php');}

?>



				<div class="twelve columns">

<div class="box_c">
						<div class="box_c_heading cf">
							<div class="box_c_ico"><img src="/img/ico/icSw2/16-Graph.png" alt="" /></div><p>Notificacion de Cambio de Turno</p>
						</div>
						<div class="box_c_content">
                        <center><h3>Notificacion de modificacion de horarios</h3></center>
                        <hr />
                        <label style="width: 80%; float:left;">
                        	Dia de Turno: <font style="padding: 5px;" size="+1" ><?php echo $row_cback['dia']; ?></font>
                        </label>
                        <label style="width: 80%; float:left;">
                        	Hora de Entrada (Nueva): <font style="padding: 5px;" size="+1" ><?php echo $row_cback['hentrada_new']; ?></font>
                        </label>
                        <label style="width: 80%; float:left;">
                        	Hora de Salida (Nueva): <font style="padding: 5px;" size="+1" ><?php echo $row_cback['hsalida_new']; ?></font>
                        </label>
                        <label style="width: 80%; float:left;">
                        	Hora de Break1 (Nueva): <font style="padding: 5px;" size="+1" ><?php echo $row_cback['hbreak1_new']; ?></font>
                        </label>
                        <label style="width: 80%; float:left;">
                        	Hora de Almuerzo (Nueva): <font style="padding: 5px;" size="+1" ><?php echo $row_cback['halmuerzo_new']; ?></font>
                        </label>
                        <label style="width: 80%; float:left;">
                        	Hora de Break2 (Nueva): <font style="padding: 5px;" size="+1" ><?php echo $row_cback['hbreak2_new']; ?></font>
                        </label>
                        <br />
                        <hr />
						</div>
					</div>

<?php } ?>