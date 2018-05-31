<?php require_once('Connections/cae.php'); ?>
<?php 


if (!empty($_GET['fg'])) {

	if(($_GET['fg']) == "area") { include('include/delarea.php'); }
	elseif (($_GET['fg']) == "status") { include('include/delstatus.php'); }
	elseif (($_GET['fg']) == "gotokback") { include('include/delbackcierre.php'); }
} else { header('Location: index.php'); }

?>