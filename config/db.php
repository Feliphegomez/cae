<?php

class ConsultaAPI {
	var $error = true;
	#var $error_details = array();
	var $options = array();
	var $options_count = 0;
	#var $response = 0;
	#var $response_text = 0;
	#var $total = 0;
	#var $data = array();
	
	function __construct(){
		$this->error = false;
		$this->options = func_get_args();
		$this->options_count = func_num_args();

		$this->response_text = "Number of arguments: $this->options_count\n";
	}

	

	function __toString(){ return $this; }
	
	function json(){ return json_encode($this); }
}

