<?php 

ini_set('display_errors', 1); # show error reporting
error_reporting(E_ALL); # show error reporting


define('SITE_NAME', 'Sitio Web {{ name }}');


define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'restapi');
define('API_KEY','3d524a53c110e4c22463b10ed32cef9d'); # referencia generado con MD5(uniqid(&lt;some_string&gt;, true))


header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

 
$home_url="http://cae.demedallo.com/api/"; # URL de la Pagina Principal
$page = isset($_GET['page']) ? $_GET['page'] : 1; # página dada en el parámetro URL, la página predeterminada es uno
$records_per_page = 5; # establecer el número de registros por página
$from_record_num = ($records_per_page * $page) - $records_per_page; # calcular para la consulta cláusula LIMIT



