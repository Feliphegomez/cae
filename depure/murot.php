<?php include("include/classes/session.php"); ?>
<?php require_once('Connections/cae.php'); ?>
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


$var_username_cinfoperfil = "-1";
if (isset($session->username)) {
  $var_username_cinfoperfil = $session->username;
}
mysql_select_db($database_cae, $cae);
$query_cinfoperfil = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($var_username_cinfoperfil, "text"));
$cinfoperfil = mysql_query($query_cinfoperfil, $cae) or die(mysql_error());
$row_cinfoperfil = mysql_fetch_assoc($cinfoperfil);
$totalRows_cinfoperfil = mysql_num_rows($cinfoperfil);

mysql_select_db($database_cae, $cae);
$query_ctback = "SELECT * FROM backoffice";
$ctback = mysql_query($query_ctback, $cae) or die(mysql_error());
$row_ctback = mysql_fetch_assoc($ctback);
$totalRows_ctback = mysql_num_rows($ctback);

mysql_select_db($database_cae, $cae);
$query_cback = "SELECT * FROM backoffice WHERE backoffice.asignadoa = '$session->username'";
$cback = mysql_query($query_cback, $cae) or die(mysql_error());
$row_cback = mysql_fetch_assoc($cback);
$totalRows_cback = mysql_num_rows($cback);

mysql_select_db($database_cae, $cae);
$query_ctbackok = "SELECT * FROM backoffice WHERE backoffice.ok = '1'";
$ctbackok = mysql_query($query_ctbackok, $cae) or die(mysql_error());
$row_ctbackok = mysql_fetch_assoc($ctbackok);
$totalRows_ctbackok = mysql_num_rows($ctbackok);

mysql_select_db($database_cae, $cae);
$query_ctusers = "SELECT * FROM users";
$ctusers = mysql_query($query_ctusers, $cae) or die(mysql_error());
$row_ctusers = mysql_fetch_assoc($ctusers);
$totalRows_ctusers = mysql_num_rows($ctusers);
?>
<?php if (($session->logged_in)){ 	?>

 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title> CAE - Control y Asistencia de Empleados</title>

			<link rel="stylesheet" href="/foundation/stylesheets/foundation.css" />
			<link rel="stylesheet" href="/lib/jQueryUI/css/Aristo/Aristo.css" media="all" />
			<link rel="stylesheet" href="/lib/fancybox/jquery.fancybox-1.3.4.css" media="all" />
			<link rel="stylesheet" href="/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" media="all" />
			<link rel="stylesheet" href="/lib/elfinder/css/elfinder.min.css" media="all" />
			<link rel="stylesheet" href="/lib/chosen/chosen.css" media="all" />
			<link rel="stylesheet" href="/lib/ibutton/css/jquery.ibutton.css" media="all" />
			<link rel="stylesheet" href="/lib/tagHandler/css/jquery.taghandler.css" media="all" />
			<link rel="stylesheet" href="/css/style.css" />


		<!-- Favicons and the like (avoid using transparent .png) -->
			<link rel="shortcut icon" href="/favicon.ico" />
			<link rel="apple-touch-icon-precomposed" href="/icon.png" />

		<!--[if lt IE 9]>
			<link rel="stylesheet" href="/foundation/stylesheets/ie.css" />
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body class="ptrn_a grdnt_a mhover_a">
		<?php include('include/header.php') ?>
        <div class="container">
			<div class="row">
				<div class="twelve columns">
					<?php include('include/publicacion.php') ?>
				</div>
			</div>
            
			<?php include('include/muro.php') ?>
            
		</div>
		<?php include('include/footer.php'); ?>
		<script src="js/jquery.min.js"></script>
		<script src="lib/jQueryUI/jquery-ui-1.8.18.custom.min.js"></script>
		<script src="js/s_scripts.js"></script>
		<script src="js/jquery.ui.extend.js"></script>
		<script src="lib/qtip2/jquery.qtip.min.js"></script>
        <script src="lib/tiny_mce/jquery.tinymce.js"></script>
		<script src="lib/plupload/js/plupload.full.js"></script>
		<script src="lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
		<script src="lib/chosen/chosen.jquery.min.js"></script>
		<script src="lib/timepicker/jquery-ui-timepicker-addon.js"></script>
		<script src="lib/ibutton/jquery.ibutton.min.js"></script>
		<script src="js/ui.spinner.js"></script>
		<script src="lib/raty/jquery.raty.min.js"></script>
		<script src="js/jquery.inputmask.js"></script>
		<script src="js/jquery.inputmask.extentions.js"></script>
		<script src="lib/tagHandler/js/jquery.taghandler.min.js"></script>
		<script src="js/pertho.js"></script>
		<script>
			$(document).ready(function() {
				//* common functions
				prth_common.init();

				//* autosize textareas
				prth_textarea_auto.init();
				prth_limiter.init();
				//* input spinners
                prth_spinner.init();
				if(!is_touch_device){
					//wysiwyg editor

					prth_editor.html();
					//fileuplaod
					prth_fileUpload.init();
				}
				//* extended select elements
				prth_chosen_select.init();
				//* datepicker & timepicker
				prth_dp_tp.init();
				//* animated progressbar
				prth_progressbar.init();
				//* ui sliders
				prth_sliders.init();
				//* rating
				prth_rating.init();
				//* iOS style checkboxes
				prth_ios_checkboxes.init();
				// masked inputs
				prth_mask_input.init();
				//* tag handler
				prth_tag_handler.init();
			});
		</script>
	</body>
</html>




<?php
mysql_free_result($cinfoperfil);

mysql_free_result($ctback);

mysql_free_result($ctbackok);

mysql_free_result($ctusers);
 } else { header('Location: index.php'); }  ?>
 
 
 
 
 
 
 
 