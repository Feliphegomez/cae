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

mysql_select_db($database_cae, $cae);
$query_cgroupmsg = "SELECT * FROM users ORDER BY `names` ASC";
$cgroupmsg = mysql_query($query_cgroupmsg, $cae) or die(mysql_error());
$row_cgroupmsg = mysql_fetch_assoc($cgroupmsg);
$totalRows_cgroupmsg = mysql_num_rows($cgroupmsg);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO tickets (`create`, destination, fcreation, asunto, mgs) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['create'], "text"),
                       GetSQLValueString($_POST['destination'], "text"),
                       GetSQLValueString($_POST['fcreation'], "text"),
                       GetSQLValueString($_POST['asunto'], "text"),
                       GetSQLValueString($_POST['mgs'], "text"));

  mysql_select_db($database_cae, $cae);
  $Result1 = mysql_query($insertSQL, $cae) or die(mysql_error());

  $insertGoTo = "/outbox/";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: /outbox/"));
}

ini_set('date.timezone','America/Bogota'); 
$time = date("H:i");
$date = date("Y-m-d H:i");
?>

<div class="box_c">
	<div class="box_c_heading cf">
        <p>Enviar Mensaje / Ticket de Ayuda</p>
    </div>
    <div class="box_c_content">
        <div class="row">
            <div class="twelve columns">
              <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
              
                <label for="para" style="width: 75px; float:left;">
                <font style="padding: 5px;" size="+1" >Para:&nbsp;</font>
                </label>
                
                <input list="browsers" type="text" id="para" class="input-text oversize" name="destination" value="<?php if(!empty($_POST['destination'])) { echo $_POST['destination']; } ?>" size="32" style="border-radius: 10px; width: 80%;float:right;" />
                
                    <datalist id="browsers">
                        <?php do { ?>
                            <option value="<?php echo $row_cgroupmsg['username']; ?>"></option>
                        <?php } while ($row_cgroupmsg = mysql_fetch_assoc($cgroupmsg)); ?>
                    </datalist>       
                                                 
                <label for="asunto" style="width: 75px; float:left;">
                	<font style="padding: 5px;" size="+1" >Asunto:&nbsp;</font>
                </label>
                
                <input type="text" id="asunto" class="input-text oversize" name="asunto" value="<?php if(!empty($_POST['asunto'])) { echo $_POST['asunto']; } ?>" style="float:right; border-radius: 10px; width: 80%;" />
                <hr />
               <?php include('txtedit/textedit.php'); ?>
                    <textarea id="editor" name="mgs"><?php if(!empty($_POST['mgs'])) { echo $_POST['mgs']; } ?></textarea>
				<?php include('txtedit/texteditfoot.php'); ?>
                
                <hr />
                <input style="float:right;" class="button blue radius nice" type="submit" value="Enviar Mensaje" />
                <input type="hidden" name="create" value="<?php echo $session->username ?>" />
                <input type="hidden" name="MM_insert" value="form1" />
                <input type="hidden" name="fcreation" value="<?php echo $date; ?>" />
              </form>
            </div>
        </div>
    </div>
</div>
<?php
mysql_free_result($cgroupmsg);
?>
