<?php

namespace src\Models;

use MF\Model\Model;

class SobreNosDAO extends Model {

	protected $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getSobreNos()
	{	
		return ['a', 'b', 'c'];
		//$query = 'select id, nome, carro, descricao, preco from tb_pecas';
		//return $this->db->query($query)->fetchAll();
	}

	public function getSobreNosNovo()
	{	
		return ['x', 'y', 'z'];
	}
}