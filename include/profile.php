
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
$query_cturnosperfil = sprintf("SELECT * FROM horarios WHERE login = %s ORDER by dia DESC", GetSQLValueString($colname_cturnosperfil, "text"));
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
          <?php include('include/menuperfil.php'); ?>
        </div>
    <?php } else { header('Location: /login/'); } ?>
</div>


<!-- 

Page

-->

<?php if (($_GET['act']) == 'verperfil'){ 	?>
    <div class="eight columns">
        <div class="box_c">
            <div class="box_c_heading cf">
                <div class="box_c_ico"><img src="/img/ico/icSw2/16-Table.png" alt="" /></div><p>Informacion de Usuario</p>
            </div>
            <div class="box_c_content" style="width:auto;">
                <div style="padding: 15px; height:325px;">
                    <img src="<?php echo $row_cprofilesinfo['img']; ?>" style="background-repeat:no-repeat; margin-top: 35px; background-size: contain; background-position:center; background-image:url(/img/logo.png); width:150px; height:200px; float: left;" />
                  <div style="float:right;">
                        	<div style="float:left;">
                              <table class="display dt_act mobile_dt3" id="content_table" style="width: 400px;">
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['names']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['genere']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['area']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['userlevel']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['parent_directory']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['email']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['notas']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['tfijo']; ?></td>
                                  </tr>
                                  <tr style="text-align:center;">
                                    <td><?php echo $row_cprofilesinfo['tmovil']; ?></td>
                                  </tr>
                        		</table>
                        	</div>
        				</div>
                    </div>
                </div>
      </div>
</div>
    </div>
<?php mysql_free_result($cprofilesinfo); }
		elseif (($_GET['act']) == 'calendars') { ?>
    <div class="eight columns">
        <div class="box_c">
            <div class="box_c_heading cf">
                <div class="box_c_ico"><img src="/img/ico/icSw2/16-Table.png" alt="" /></div><p>Turnos de Usuario</p>
            </div>
          <div class="box_c_content">
            <table cellpadding="0" cellspacing="0" border="0" class="display mobile_dt1 dt_act" id="dt1">
                                <thead>
                                    <tr>
                                        <th class="essential">Dia</th>
                                        <th class="essential">Skill</th>
                                        <th>Hora Entrada</th>
                                        <th>Hora Salida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php do { ?>
                                      <tr>
                                        <td><a href="/calendar/<?php echo $row_cturnosperfil['login']; ?>/<?php echo $row_cturnosperfil['dia']; ?>/"><?php echo $row_cturnosperfil['dia']; ?></a></td>
                                        <td><?php echo $row_cturnosperfil['skill']; ?></td>
                                        <td><?php echo $row_cturnosperfil['hentrada']; ?></td>
                                        <td><?php echo $row_cturnosperfil['hsalida']; ?></td>
                                      </tr>
								  <?php } while ($row_cturnosperfil = mysql_fetch_assoc($cturnosperfil)); ?>
                                </tbody>
            </table>
          </div>
        </div>
    </div>
		<?php
mysql_free_result($cprofilesinfo);

mysql_free_result($cturnosperfil);  } else { header('Location: /index.php'); } 
?>