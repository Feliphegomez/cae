
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

$colname_cprofilesinfo = "-1";
if (isset($_GET['user'])) {
  $colname_cprofilesinfo = $_GET['user'];
}
mysql_select_db($database_cae, $cae);
$query_cprofilesinfo = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($colname_cprofilesinfo, "text"));
$cprofilesinfo = mysql_query($query_cprofilesinfo, $cae) or die(mysql_error());
$row_cprofilesinfo = mysql_fetch_assoc($cprofilesinfo);
$totalRows_cprofilesinfo = mysql_num_rows($cprofilesinfo);

$colname_cturnosperfil = "-1";
if (isset($_GET['user'])) {
  $colname_cturnosperfil = $_GET['user'];
}
mysql_select_db($database_cae, $cae);
$query_cturnosperfil = sprintf("SELECT * FROM horarios WHERE login = %s AND dia = '$_GET[date]' ORDER by dia DESC", GetSQLValueString($colname_cturnosperfil, "text"));
$cturnosperfil = mysql_query($query_cturnosperfil, $cae) or die(mysql_error());
$row_cturnosperfil = mysql_fetch_assoc($cturnosperfil);
$totalRows_cturnosperfil = mysql_num_rows($cturnosperfil);
?>
<!-- Left Menu -->

<div class="four columns">
    
    <?php  if (($session->logged_in)){  ?>
        <div class="box_c">
            <div class="box_c_heading cf">
                <div class="box_c_ico"><img src="/img/ico/icSw2/16-Users-2.png" alt="" /></div><p style="text-transform:capitalize; font-weight: 900;"><?php echo $row_cprofilesinfo['username']; ?></p>
          </div>
            <div class="box_c_content">
                <ul class="overview_list">
                    <li>
                        <a href="/users/<?php echo $row_cprofilesinfo['username']; ?>">
                            <img src="/img/blank.gif" style="background-image: url(/img/ico/open/ID.png)" />
                            <span class="ov_nb">&nbsp;</span>
                            <span class="ov_text">Informacion Personal</span>
                        </a>
                    </li>
                    <li>
                        <a href="/calendars/<?php echo $row_cprofilesinfo['username']; ?>">
                            <img src="/img/blank.gif" style="background-image: url(/img/ico/open/lamp.png)" />
                            <span class="ov_nb">&nbsp;</span>
                            <span class="ov_text">Horarios de Trabajo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php } else { header('Location: /login/'); } ?>
</div>


<!-- 

Page

-->

<?php if (!empty($_GET['user'])){ ?>
<div class="eight columns">
    <div class="box_c">
        <div class="box_c_heading cf">
            <div class="box_c_ico"><img src="/img/ico/icSw2/16-Table.png" alt="" /></div><p>Informacion de Usuario</p>
        </div>
        <div class="box_c_content" style="width:auto;">
            <table class="display dt_act mobile_dt3" id="content_table" style="width: 400px;">
            <thead>
                <tr style="text-align:left;">
                    <td>Dia</td>
                    <th><?php echo $row_cturnosperfil['dia']; ?></th>
                </tr>
            </thead>
                <tr style="text-align:left;">
                    <td>Hora Entrada</td>
                    <td><?php echo $row_cturnosperfil['hentrada']; ?></td>
                </tr>
                <tr style="text-align:left;">
                    <td>1 Break</td>
                    <td><?php echo $row_cturnosperfil['hbreak1']; ?></td>
                </tr>
                <tr style="text-align:left;">
                    <td>Almuerzo</td>
                    <td><?php echo $row_cturnosperfil['halmuerzo']; ?></td>
                </tr>
                <tr style="text-align:left;">
                    <td>2 Break</td>
                    <td><?php echo $row_cturnosperfil['hbreak2']; ?></td>
                </tr>
                <tr style="text-align:left;">
                    <td>Hora de Salida</td>
                    <td><?php echo $row_cturnosperfil['hsalida']; ?></td>
                </tr>
                <tr style="text-align:left;">
                    <td>Area</td>
                    <td><?php echo $row_cturnosperfil['skill']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php mysql_free_result($cprofilesinfo); 

mysql_free_result($cturnosperfil);
?>
<?php }  else { header('Location: /index.php'); } ?>


    