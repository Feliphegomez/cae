<?php
include('../config/autoload.php');


$fields = array();
$fields['name'] = 'my name';


$ConsultaAPI = new ConsultaAPI($fields);
echo $ConsultaAPI->json();