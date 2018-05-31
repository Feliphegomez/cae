
<?php //* require_once('../Connections/cae.php'); ?>
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

$maxRows_cmsgview = 5;
$pageNum_cmsgview = 0;
if (isset($_GET['pageNum_cmsgview'])) {
  $pageNum_cmsgview = $_GET['pageNum_cmsgview'];
}
$startRow_cmsgview = $pageNum_cmsgview * $maxRows_cmsgview;

mysql_select_db($database_cae, $cae);
$query_cmsgview = "SELECT * FROM tickets WHERE visto = 0 AND tickets.destination = '$session->username' ORDER BY fcreation DESC";
$query_limit_cmsgview = sprintf("%s LIMIT %d, %d", $query_cmsgview, $startRow_cmsgview, $maxRows_cmsgview);
$cmsgview = mysql_query($query_limit_cmsgview, $cae) or die(mysql_error());
$row_cmsgview = mysql_fetch_assoc($cmsgview);

if (isset($_GET['totalRows_cmsgview'])) {
  $totalRows_cmsgview = $_GET['totalRows_cmsgview'];
} else {
  $all_cmsgview = mysql_query($query_cmsgview);
  $totalRows_cmsgview = mysql_num_rows($all_cmsgview);
}
$totalPages_cmsgview = ceil($totalRows_cmsgview/$maxRows_cmsgview)-1;

$maxRows_ctrabasig = 5;
$pageNum_ctrabasig = 0;
if (isset($_GET['pageNum_ctrabasig'])) {
  $pageNum_ctrabasig = $_GET['pageNum_ctrabasig'];
}
$startRow_ctrabasig = $pageNum_ctrabasig * $maxRows_ctrabasig;

mysql_select_db($database_cae, $cae);
$query_ctrabasig = "SELECT * FROM backoffice WHERE asignadoa = '$session->username' AND ok = 0";
$query_limit_ctrabasig = sprintf("%s LIMIT %d, %d", $query_ctrabasig, $startRow_ctrabasig, $maxRows_ctrabasig);
$ctrabasig = mysql_query($query_limit_ctrabasig, $cae) or die(mysql_error());
$row_ctrabasig = mysql_fetch_assoc($ctrabasig);

if (isset($_GET['totalRows_ctrabasig'])) {
  $totalRows_ctrabasig = $_GET['totalRows_ctrabasig'];
} else {
  $all_ctrabasig = mysql_query($query_ctrabasig);
  $totalRows_ctrabasig = mysql_num_rows($all_ctrabasig);
}
$totalPages_ctrabasig = ceil($totalRows_ctrabasig/$maxRows_ctrabasig)-1;

mysql_select_db($database_cae, $cae);
$query_cmodcald = "SELECT * FROM temp_turnos WHERE login = '$session->username' AND view = 0";
$cmodcald = mysql_query($query_cmodcald, $cae) or die(mysql_error());
$row_cmodcald = mysql_fetch_assoc($cmodcald);
$totalRows_cmodcald = mysql_num_rows($cmodcald);

mysql_select_db($database_cae, $cae);
$query_cinfoact = "SELECT * FROM users WHERE username = '$session->username'";
$cinfoact = mysql_query($query_cinfoact, $cae) or die(mysql_error());
$row_cinfoact = mysql_fetch_assoc($cinfoact);
$totalRows_cinfoact = mysql_num_rows($cinfoact);

?>

<header>
    <!-- notifications content -->
        <div id="ntf_tickets_panel" style="display:none">
            <p class="sticky-title">Modificacion de Turnos</p>
            <?php if (($totalRows_cmodcald) > 0) { ?>
          <ul class="sticky-list">
			  <?php do { ?>
                <li>
                    <a href="/view/turns/confirm/?fg=<?php echo $row_cmodcald['id']; ?>"><?php echo $row_cmodcald['modby']; ?></a> a modificado un turno tuyo.
                  <p><span class="s_color small">Turno: <a href="/view/turns/confirm/?fg=<?php echo $row_cmodcald['id']; ?>"><?php echo $row_cmodcald['dia']; ?></a></span></p>
                </li>
			  <?php } while ($row_cmodcald = mysql_fetch_assoc($cmodcald)); ?>
            </ul>
			<?php } else { echo "No tienes modificaciones de turno."; } ?>
            <hr />
            <a href="/timetable/" class="gh_button btn-small">Mis Turnos</a>
        </div>
        
        
        
        
        
        
        <div id="ntf_comments_panel" style="display:none">
            <p class="sticky-title">Tabajo Pendiente</p>
            <?php if (($totalRows_ctrabasig) > 0) { ?>
            <ul class="sticky-list">
                <?php do { ?>
                <li>
                    
                    <form action="/back/cierre/" method="post" style="display: table-row;">
                      <input name="orden" style="background-color:transparent; border: 0;" type="submit" value="<?php echo $row_ctrabasig['orden']; ?>" />
                      <button value="<?php echo $row_ctrabasig['orden']; ?>"  name="orden" type="submit"  style=" border: 0; background-color: transparent;">
                      <p><span class="s_color small"><?php echo $row_ctrabasig['cuenta']; ?> (<?php echo $row_ctrabasig['estado']; ?>)</span></p></button></form>
                </li>
                  <?php } while ($row_ctrabasig = mysql_fetch_assoc($ctrabasig)); ?>
            </ul>
			<?php } else { echo "No tienes trabjo penditen, MUY BIEN!..."; } ?>
            <hr />
            <a href="/backoffice/" class="gh_button btn-small">Ver Todos Los Trabajos</a>
        </div>
        
        
        
        
        
        
        <div id="ntf_mail_panel" style="display:none">
            <p class="sticky-title">Mensajes Nuevos</p>
            <?php if (($totalRows_cmsgview) > 0) { ?>
            <ul class="sticky-list">
                <?php do { ?>
                <li>
                    <a href="/message/view/<?php echo $row_cmsgview['id']; ?>"><?php if (!empty($row_cmsgview['asunto'])) { echo $row_cmsgview['asunto']; } else { echo "- Sin Asunto - "; } ?></a>
                    <p><span class="s_color small">De: <?php echo $row_cmsgview['destination']; ?> (<?php echo $row_cmsgview['fcreation']; ?>)</span></p>
                </li>
                  <?php } while ($row_cmsgview = mysql_fetch_assoc($cmsgview)); ?>
            </ul>
			<?php } else { echo "No tienes mensajes nuevos."; } ?>
            <hr />
          <a href="/inbox/" class="gh_button btn-small">Ver Todos Los Mensajes</a>
        </div>
    </div>

    <div class="container head_s_a">
        <div class="row sepH_b">
            <div class="six columns">
                <div class="row">
                    <div class="five phone-two columns">
                        <div id="logo">
                            <img src="/img/logo.png" />
                        </div>
                    </div>
                    <div class="seven phone-two columns">
                    </div>
                </div>
            </div>
            <div class="six columns">
                <div class="user_box cf">
                    <div class="user_avatar">
                        <img src="/<?php if (($row_cinfoperfil['genere']) == "F") { echo "img/user_female.png"; } elseif (($row_cinfoperfil['genere']) == "M") { echo "img/user_male.png"; } ?>" />
                    </div>
                    <div class="user_info user_sep">
                        <p class="sepH_a">
                            <strong><a href="/users/<?php echo $session->username ?>"><?php echo $row_cinfoperfil['names']; ?></a></strong>
                        </p>
                        <span>
                            <a href="/profile">Editar Perfil</a>
                        </span>
                         | 
                        <span>
                            <a href="/logout">Salir</a>
                        </span>
                    </div>
                    <div class="ntf_bar user_sep">
                        <a href="#ntf_mail_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Mail.png)">
                        
                         <?php if (($totalRows_cmsgview) > 0) { echo "<span class='ntf_tip ntf_tip_red'><span>$totalRows_cmsgview</span></span>"; } ?>
                            
                      </a>
                        <a href="#ntf_tickets_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Day-Calendar.png)">
                        <?php if (($totalRows_cmodcald) > 0) { echo "<span class='ntf_tip ntf_tip_red'><span>$totalRows_cmodcald</span></span>"; } ?>
                        </a>
                        <a href="#ntf_comments_panel" class="ntf_item" style="background-image: url(/img/ico/icSw2/32-Speech-Bubble.png)">
                        
                        <?php if (($totalRows_ctrabasig) > 0) { echo "<span class='ntf_tip ntf_tip_blue'><span>$totalRows_ctrabasig</span></span>"; } ?>
                            
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <nav id="smoothmenu_h" class="ddsmoothmenu tinyNav">
                    <ul class="cf">
                    <?php if (($session->logged_in) && ($session->isMember())){ ?>
                        <li><a href="/dashboard/" class="mb_parent">Dashboard</a></li>
                        <li><a href="/group/" class="mb_parent">Mi Grupo</a></li>
                        <li><a href="/timetable/" class="mb_parent">Mi Horario</a></li>
                        <li><a href="/messages/" class="mb_parent">Tickets</a></li>
                        <li><a href="/backoffice/" class="mb_parent">Trabajo Asignado</a></li>
                        
                        
                        
                        
                    <?php } elseif (($session->logged_in) && ($session->isAgent())){ ?>
                        <li><a href="/dashboard/" class="mb_parent">Dashboard</a></li>
                        <li><a href="/group/" class="mb_parent">Mi Grupo</a></li>
                        <li><a href="/timetable/" class="mb_parent">Mi Horario</a></li>
                        <li><a href="/messages/" class="mb_parent">Tickets</a></li>
                        <li><a href="/backoffice/" class="mb_parent">Trabajo Asignado</a></li>
                        <li><a href="/asigned/" class="mb_parent">Mi Personal</a></li>
                        
                        <li style="float:right;"><a href="/boss/" class="mb_parent">Herramientas</a></li>
                        
                        
                        
                        
                    <?php } elseif (($session->logged_in) && ($session->isMaster())){ ?>
                        <li><a href="/dashboard/" class="mb_parent">Dashboard</a></li>
                        <li><a href="/group/" class="mb_parent">Mi Grupo</a></li>
                        <li><a href="/timetable/" class="mb_parent">Mi Horario</a></li>
                        <li><a href="/messages/" class="mb_parent">Tickets</a></li>
                        <li><a href="/backoffice/" class="mb_parent">Trabajo Asignado</a></li>
                        <li><a href="/asigned/" class="mb_parent">Mi Personal</a></li>
                        
                        <li style="float:right;"><a href="/master/" class="mb_parent">Panel-Master</a></li>
                        
                        
                        
                    <?php } elseif (($session->logged_in) && ($session->isAdmin())){ ?>
                        <li><a href="/dashboard/" class="mb_parent">Dashboard</a></li>
                        <li><a href="/group/" class="mb_parent">Mi Grupo</a></li>
                        <li><a href="/timetable/" class="mb_parent">Mi Horario</a></li>
                        <li><a href="/messages/" class="mb_parent">Tickets</a></li>
                        <li><a href="/backoffice/" class="mb_parent">Trabajo Asignado</a></li>
                        <li><a href="/asigned/" class="mb_parent">Mi Personal</a></li>
                        
                        <li style="float:right;"><a href="/admins/" class="mb_parent">Panel-ADMIN</a></li>
                        
                    <?php } ?>
                    
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php
mysql_free_result($cmsgview);

mysql_free_result($ctrabasig);

mysql_free_result($cmodcald);

mysql_free_result($cinfoact);

?>
