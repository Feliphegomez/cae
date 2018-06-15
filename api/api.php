<?php
include('../config/autoload.php');

$consulta = new stdClass();
$consulta->mode = 'obj';
$consulta->table = 'users';
$consulta->fields_return = array();
$consulta->order = array();

$ConsultaAPI = new ConsultaAPI($consulta);
echo $ConsultaAPI->json();