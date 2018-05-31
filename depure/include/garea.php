<div class="box_c">
                        <div class="box_c_heading cf">
                            <p>Personal de Area</p>
                        </div>
                        <div class="box_c_content">
                            <table class="display dt_act mobile_dt3" id="content_table">
                                <thead align="">
                                    <tr>
                                        <th class="essential"><center>Usuario</center></th>
                                        <th><center>Nombres y Apellidos</center></th>
                                        <th><center>Jefe Directo</center></th>
                                        <th><center>Genero</center></th>
                                        <th class="essential"><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php do { ?> 
                                    <tr>
                                        <td align="center"><a href="/users/<?php echo $row_cmiarea['username']; ?>"><?php echo $row_cmiarea['username']; ?></a></td>
                                        <td><?php echo $row_cmiarea['names']; ?></td>
                                        <td align="center"><a href="/users/<?php echo $row_cmiarea['parent_directory']; ?>" class="small"><?php echo $row_cmiarea['parent_directory']; ?></a></td>
                                        <td><?php if(($row_cmiarea['genere']) == 'M') { echo "Hombre"; } elseif(($row_cmiarea['genere']) == 'F') { echo "Mujer"; }?></td>
                                        <td class="content_actions" align="center">
                                        <a href="/users/<?php echo $row_cmiarea['username']; ?>" class="sepV_a" title="Ver Perfil : <?php echo $row_cmiarea['username']; ?>"><img src="/img/ico/open/agent.png" alt="" /></a>
                                        <a href="/calendars/<?php echo $row_cmiarea['username']; ?>/" class="sepV_a" title="Ver Horarios : <?php echo $row_cmiarea['username']; ?>"><img src="/img/ico/open/calendar.png" alt="" /></a></td>
                                    </tr>
                                <?php } while ($row_cmiarea = mysql_fetch_assoc($cmiarea)); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>