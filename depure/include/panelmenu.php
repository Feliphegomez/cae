<nav id="smoothmenu_v" class="ddsmoothmenu" style="opacity: 0.8;">
                        <ul class="cf">
								<?php if (($session->userlevel) == '9'){ ?>
                    
                        <li class="inner_heading"><img src="/img/ico/open/calendar.png" style="float:left;" /><a style="float:left;"  href="/turnos/new/" class="mb_parent first_el">Asignar Turnos</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/arrow-round.png" style="float:left;" /><a style="float:left;"  href="/turnos/mod/" class="mb_parent first_el">Modificar Turno</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/briefcase.png" style="float:left;" /><a style="float:left;"  href="/job/" class="mb_parent first_el">Asignar Trabajo</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/multi-agents.png" style="float:left;" /><a style="float:left;"  href="/user/new/" class="mb_parent first_el">Agregar Personal</a></li>
                    <li class="inner_heading"><img src="/img/ico/open/lookup.png" style="float:left;" /><a style="float:left;"  href="/user/alls/" class="mb_parent first_el">Todos Los Usuarios</a></li>
                    <li class="inner_heading"><img src="/img/ico/open/processing.png" style="float:left;" /><a style="float:left;"  href="/widgets/" class="mb_parent first_el">Complementos</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/reload.png" style="float:left;" /><a style="float:left;"  href="/reactivate/" class="mb_parent first_el">Reactivar Trabajo</a></li>
                        
								<?php }  elseif(($session->userlevel) == '8' ){ ?>
                
                        <li class="inner_heading"><img src="/img/ico/open/calendar.png" style="float:left;" /><a style="float:left;"  href="/turnos/new/" class="mb_parent first_el">Asignar Turnos</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/arrow-round.png" style="float:left;" /><a style="float:left;"  href="/turnos/mod/" class="mb_parent first_el">Modificar Turno</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/briefcase.png" style="float:left;" /><a style="float:left;"  href="/job/" class="mb_parent first_el">Asignar Trabajo</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/multi-agents.png" style="float:left;" /><a style="float:left;"  href="/user/new/" class="mb_parent first_el">Agregar Personal</a></li>
                    <li class="inner_heading"><img src="/img/ico/open/processing.png" style="float:left;" /><a style="float:left;"  href="/widgets/" class="mb_parent first_el">Complementos</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/reload.png" style="float:left;" /><a style="float:left;"  href="/reactivate/" class="mb_parent first_el">Reactivar Trabajo</a></li>
                
                 <?php } elseif(($session->userlevel) == '1' ){ ?>
						
                        <li class="inner_heading"><img src="/img/ico/open/calendar.png" style="float:left;" /><a style="float:left;"  href="/turnos/new/" class="mb_parent first_el">Asignar Turnos</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/arrow-round.png" style="float:left;" /><a style="float:left;"  href="/turnos/mod/" class="mb_parent first_el">Modificar Turno</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/briefcase.png" style="float:left;" /><a style="float:left;"  href="/job/" class="mb_parent first_el">Asignar Trabajo</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/multi-agents.png" style="float:left;" /><a style="float:left;"  href="/user/new/" class="mb_parent first_el">Agregar Personal</a></li>
                        <li class="inner_heading"><img src="/img/ico/open/reload.png" style="float:left;" /><a style="float:left;"  href="/reactivate/" class="mb_parent first_el">Reactivar Trabajo</a></li>
						
						<?php } else { header('Loction: index.php'); }?>
                        </ul>
					</nav>