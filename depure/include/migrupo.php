<div class="box_c">
                        <div class="box_c_heading cf">
                            <p>Jefe Directo: <a href="/users/<?php echo $row_cmigrupo['parent_directory']; ?>"><?php echo $row_cmigrupo['parent_directory']; ?></a></p>
                        </div>
                        <div class="box_c_content">
                            <table class="display dt_act mobile_dt3" id="content_table">
                                <thead>
                                    <tr>
                                        <th class="essential"><center>Usuario</center></th>
                                        <th><center>Nombres y Apellidos</center></th>
                                        <th><center>Area</center></th>
                                        <th><center>Genero</center></th>
                                        <th class="essential"><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php do { ?>
                                    <tr>
                                        <td align="center"><a href="/users/<?php echo $row_cmigrupo['username']; ?>"><?php echo $row_cmigrupo['username']; ?></a></td>
                                        <td><?php echo $row_cmigrupo['names']; ?></td>
                                        <td><?php echo $row_cmigrupo['area']; ?></td>
                                        <td><?php if(($row_cmigrupo['genere']) == 'M') { echo "Hombre"; } elseif(($row_cmigrupo['genere']) == 'F') { echo "Mujer"; }?></td>
                                        <td class="content_actions" align="center">
                                        	<a href="/users/<?php echo $row_cmigrupo['username']; ?>" class="sepV_a" title="Ver Perfil : <?php echo $row_cmigrupo['username']; ?>"><img src="/img/ico/open/agent.png" alt="" /></a>
                                       		<a href="/calendars/<?php echo $row_cmigrupo['username']; ?>/" class="sepV_a" title="Ver Horarios : <?php echo $row_cmigrupo['username']; ?>"><img src="/img/ico/open/calendar.png" alt="" /></a></td>
                                    </tr>
                                    
                                <?php } while ($row_cmigrupo = mysql_fetch_assoc($cmigrupo)); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>