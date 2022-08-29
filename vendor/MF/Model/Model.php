<?php 

namespace MF\Model;

use src\Conexao;

abstract class Model {

	protected $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}
}