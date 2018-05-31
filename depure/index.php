<?php include("include/classes/session.php"); ?>
<?php if (($session->logged_in)){ header('Location: /dashboard/'); }
else { header('Location: /login/'); } ?>