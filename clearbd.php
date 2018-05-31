
<?php include("include/classes/session.php"); ?>

<?php if (($session->logged_in)){ 	?>

<?php include("Connections/cae.php"); ?>
<?php
$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS); mysqli_select_db($link, DB_NAME); mysqli_query($link, "TRUNCATE TABLE backoffice"); mysqli_close($link); header('Location: /job/'); ?>

<?php } else { header('Location: /job/'); } ?>