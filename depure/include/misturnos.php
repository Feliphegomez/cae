<div class="box_c">
    <div class="box_c_heading cf">
        <p>Mis Horarios</p>
    </div>
    <div class="box_c_content">
    <table cellpadding="0" cellspacing="0" border="0" class="display mobile_dt1 dt_act" id="dt1">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Skill</th>
                                        <th>Hora Entrada</th>
                                        <th>Hora Break 1</th>
                                        <th>Hora Almuerzo</th>
                                        <th>Hora Break 2</th>
                                        <th>Hora Salida</th>
                                    </tr>
                                </thead>
                                <tbody>
								  <?php do { ?>
                                    <tr>
                                        <td><?php echo $row_vhor['dia']; ?></td>
                                        <td><?php echo $row_vhor['skill']; ?></td>
                                        <td><?php echo $row_vhor['hentrada']; ?></td>
                                        <td><?php echo $row_vhor['hbreak1']; ?></td>
                                        <td><?php echo $row_vhor['halmuerzo']; ?></td>
                                        <td><?php echo $row_vhor['hbreak2']; ?></td>
                                        <td><?php echo $row_vhor['hsalida']; ?></td>
                                    </tr>
								  <?php } while ($row_vhor = mysql_fetch_assoc($vhor)); ?>
                                </tbody>
                            </table>
       <table width="100%" border="1" style="text-align: center;">
          <tr class="ssw_grdnt_d">
          </tr>
              <tr class="ssw_mhover_a">
              </tr>
       </table>

                      </div>
                    </div>