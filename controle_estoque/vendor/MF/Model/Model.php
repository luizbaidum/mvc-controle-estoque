<?php 

namespace MF\Model;

abstract class Model {

	protected $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getTime()
	{
		date_default_timezone_set('America/Sao_Paulo');
		return $this->current_time = date('d-m-y h:i:s');
	}
}