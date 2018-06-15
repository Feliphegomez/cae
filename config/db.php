<?php

class ConsultaAPI {
	var $error = true;
	var $data = array();
	var $sql = array();
	var $total = 0;
	
	function __construct($obj=array()){
		if(!isset($obj->mode)){ $obj->mode = 'obj'; };
		if(!isset($obj->table)){ $obj->table = 'None'; };
		if(!isset($obj->fields_return) || count($obj->fields_return) <= 0){ $obj->fields_return = array('*'); };
		if(!isset($obj->order) || count($obj->order) <= 0){ $obj->order = array('id'=>'ASC'); };
		$fields_return = $this->field_repair($obj->fields_return);
		$order = $this->order_repair($obj->order);
		$this->sql_obj = $obj;
		$this->sql = "Select ".$this->fields_sql_return($obj->fields_return)." from {$obj->table}"."";

		try {
			$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($this->sql); 
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			if($obj->mode == "obj"){ $result = $stmt->fetchAll(PDO::FETCH_OBJ); }
			else if($obj->mode == "assoc"){ $result = $stmt->fetchAll(PDO::FETCH_ASSOC); };
			
			$this->error = false;
			$this->data = $result;
			$this->total = count($result);
		}
		catch(PDOException $e) { $this->data = $e->getMessage(); }
		$conn = null;
	}

	function __toString(){ return $this; }

	function order_repair($order){
		$order_r = array();
		if(count($order) <= 0){ $order_r[] = array('id'=>'DESC'); }
		return $order_r;
	}

	function field_repair($fields){
		$fields_r = array();
		if(count($fields) <= 0){ $fields_r[] = '*'; }else{ $fields_r = $fields; }
		return $fields_r;
	}

	function fields_sql_return($fields=array()){
		return @implode(',', $this->field_repair($fields));
	}
	
	function json(){ return json_encode($this); }
}

