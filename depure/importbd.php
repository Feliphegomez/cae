<?php include("include/classes/session.php"); ?>

<?php
$table = 'backoffice';
if (!mysql_connect(DB_SERVER, DB_USER, DB_PASS))
    die("No se pudo establecer conexión a la base de datos<hr>");
 
if (!mysql_select_db(DB_NAME))
    die("base de datos no existe<hr>");
    if(isset($_POST['submit']))
    {
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         echo 'Cargando nombre del archivo: '.$fname.' <hr>'.'<br><a href="#" onclick="javascript:history.go(-1)">Regresar</a><br><hr>';
         $chk_ext = explode(".",$fname);
         
         if(strtolower(end($chk_ext)) == "csv")
         {
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
        
             while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
             {	 
				 
               //Insertamos los datos con los valores...
                $sql = "INSERT into backoffice(orden, cuenta, asignadoa, estado, dato1, dato2) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
                mysql_query($sql) or die(mysql_error());
             }
             //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);
             echo "Importación exitosa!<hr>".header('Location: /job/');
             
         }
         else
         {
            //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             //ver si esta separado por " , "
             echo "Archivo invalido!<hr>";
         }   
    }
     
    ?>