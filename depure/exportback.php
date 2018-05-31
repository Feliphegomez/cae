<?php include("/include/classes/session.php"); ?>
<?php 
$tablename = $_GET['tabla'];
$sql = "Select * FROM $tablename"; 
$Connect = @mysql_connect(DB_SERVER, DB_USER, DB_PASS) 
or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno()); 
$Db = @mysql_select_db(DB_NAME, $Connect) 
or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno()); 
$result = @mysql_query($sql,$Connect) 
or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno()); 

error_reporting(E_ALL);

 require_once 'Classes/PHPExcel.php';
 $objPHPExcel = new PHPExcel();

 // Set the active Excel worksheet to sheet 0 

$objPHPExcel->setActiveSheetIndex(0);  

// Initialise the Excel row number 

$rowCount = 1;  


//start of printing column names as names of MySQL fields  

 $column = 'A';

for ($i = 0; $i < mysql_num_fields($result); $i++)  

{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysql_field_name($result,$i));
    $column++;
}

//end of adding column names  
//start while loop to get data  

$rowCount = 2;  

while($row = mysql_fetch_row($result))  

{  
    $column = 'A';

   for($j= 0; $j<mysql_num_fields($result);$j++)  
    {  
        if(!isset($row[$j]))  

            $value = NULL;  

        elseif ($row[$j] != "")  

            $value = strip_tags($row[$j]);  

        else  

            $value = "";  


        $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        $column++;
    }  

    $rowCount++;
} 
$hora= date ("h:i:s");
$fecha= date ("j/M/Y");
$timeactual = $hora." ".$fecha;
 

// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="CAE BackOffice ('.$timeactual.').xls');
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');