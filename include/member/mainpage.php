


				<div class="four columns">
					<?php  if (($session->logged_in) && ($session->isMember())){  ?>
<div class="box_c">
    <div class="box_c_heading cf box_actions">
        <div class="box_c_ico"><img src="/img/ico/icSw2/16-Abacus.png" alt="" /></div>
        <p>Estadisticas</p>
    </div>
    <div class="box_c_content">
        <p class="inner_heading sepH_c">Informacion en tiempo real.</p>
        <ul class="overview_list">
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/tag.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctback ?></span>
                    <span class="ov_text">Trabajos Totales</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/bar-chart.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctbackok ?></span>
                    <span class="ov_text">Trabajos Terminados</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php }  ?>
<?php  if (($session->logged_in) && ($session->isAgent())){  ?>
<div class="box_c">
    <div class="box_c_heading cf box_actions">
        <div class="box_c_ico"><img src="/img/ico/icSw2/16-Abacus.png" alt="" /></div>
        <p>Estadisticas</p>
    </div>
    <div class="box_c_content">
        <p class="inner_heading sepH_c">Informacion en tiempo real.</p>
        <ul class="overview_list">
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/tag.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctback ?></span>
                    <span class="ov_text">Trabajos Totales</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/happy-face.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctusers ?> </span>
                    <span class="ov_text">Total de Usuarios</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/bar-chart.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctbackok ?></span>
                    <span class="ov_text">Trabajos Terminados</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php }  ?>
<?php  if (($session->logged_in) && ($session->isMaster())){  ?>
<div class="box_c">
    <div class="box_c_heading cf box_actions">
        <div class="box_c_ico"><img src="/img/ico/icSw2/16-Abacus.png" alt="" /></div>
        <p>Estadisticas</p>
    </div>
    <div class="box_c_content">
        <p class="inner_heading sepH_c">Informacion en tiempo real.</p>
        <ul class="overview_list">
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/tag.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctback ?></span>
                    <span class="ov_text">Trabajos Totales</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/happy-face.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctusers ?> </span>
                    <span class="ov_text">Total de Usuarios</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/bar-chart.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctbackok ?></span>
                    <span class="ov_text">Trabajos Terminados</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php }  ?>
<?php  if (($session->logged_in) && ($session->isAdmin())){  ?>
<div class="box_c">
    <div class="box_c_heading cf box_actions">
        <div class="box_c_ico"><img src="/img/ico/icSw2/16-Abacus.png" alt="" /></div>
        <p>Estadisticas</p>
    </div>
    <div class="box_c_content">
        <p class="inner_heading sepH_c">Informacion en tiempo real.</p>
        <ul class="overview_list">
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/tag.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctback ?></span>
                    <span class="ov_text">Trabajos Totales</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/happy-face.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctusers ?> </span>
                    <span class="ov_text">Total de Usuarios</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/blank.gif" style="background-image: url(/img/ico/open/bar-chart.png)" alt="" />
                    <span class="ov_nb"><?php echo $totalRows_ctbackok ?></span>
                    <span class="ov_text">Trabajos Terminados</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php }  ?>
				</div>
                <?php if (($session->logged_in)){ 	?>
				<div class="eight columns">
					<?php
if(!$session->isAdmin()){ ?>

<div class="box_c">
						<div class="box_c_heading cf box_actions">
							<div class="box_c_ico"><img src="/img/ico/icSw2/16-Graph.png" alt="" /></div>
							<p>Trabajo Asignado</p>
						</div>
						<div class="box_c_content">
                        
                <?php if ($totalRows_cback == 0) { // Show if recordset empty ?>
  <h3>No tienes trabajo asignado</h3>
  <?php } else {  ?>
  <table class="display dt_act mobile_dt3" id="content_table">
                                <thead>
                                    <tr>
                                      <th style="text-align:center;" class="essential">Orden</th>
                                      <th style="text-align:center;">Cuenta</th>
                                      <th style="text-align:center;">Asignado A</th>
                                      <th style="text-align:center;">Estado</th>
                                      <th style="text-align:center;" class="essential">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php do { ?>
  <tr style="text-align:center;">
    <td><a href="#"><?php echo $row_cback['orden']; ?></a></td>
    <td><?php echo $row_cback['cuenta']; ?></td>
    <td><a href="#" class="small"><?php echo $row_cback['asignadoa']; ?></a></td>
    <td><?php echo $row_cback['estado']; ?></td>
    <td class="content_actions">
      <a href="#" class="sepV_a" title="Editar"><img src="/img/ico/pencil_gray.png" /></a>
      <a href="#" class="sepV_a" title="Ver"><img src="/img/ico/preview_gray.png" /></a>
      <a href="#" title="Eliminar"><img src="/img/ico/trashcan_gray.png" /></a>
    </td>
  </tr>
  <?php } while ($row_cback = mysql_fetch_assoc($cback)); ?>
                                </tbody>
                            </table>
  <?php } ?>
						</div>
					</div>


<?php } else { ?>

<div class="box_c">
						<div class="box_c_heading cf box_actions">
							<div class="box_c_ico"><img src="/img/ico/icSw2/16-Graph.png" alt="" /></div>
							<p>Trabajo Asignado</p>
						</div>
						<div class="box_c_content">
                        
                <?php if ($totalRows_cback == 0) { // Show if recordset empty ?>
  <h3>No tienes trabajo asignado</h3>
  <?php } else {  ?>
                        
									<table class="display dt_act mobile_dt3" id="content_table">
                                <thead>
                                    <tr>
                                      <th style="text-align:center;" class="essential">Orden</th>
                                      <th style="text-align:center;">Cuenta</th>
                                      <th style="text-align:center;">Asignado A</th>
                                      <th style="text-align:center;">Estado</th>
                                      <th style="text-align:center;" class="essential">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php do { ?>
  <tr style="text-align:center;">
    <td><a href="#"><?php echo $row_ctback['orden']; ?></a></td>
    <td><?php echo $row_ctback['cuenta']; ?></td>
    <td><a href="#" class="small"><?php echo $row_ctback['asignadoa']; ?></a></td>
    <td><?php echo $row_ctback['estado']; ?></td>
    <td class="content_actions">
      <a href="#" class="sepV_a" title="Editar"><img src="/img/ico/pencil_gray.png" /></a>
      <a href="#" class="sepV_a" title="Ver"><img src="/img/ico/preview_gray.png" /></a>
      <a href="#" title="Eliminar"><img src="/img/ico/trashcan_gray.png" /></a>
    </td>
  </tr>
  <?php } while ($row_ctback = mysql_fetch_assoc($ctback)); ?>
                                </tbody>
                            </table>
 <?php } ?>
						</div>
					</div>
                    
                    
                    <?php } ?>
				</div>
                <?php } ?>