<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	public $select = 'id, nome, carro, descricao, preco';

	public function getPecas()
	{
		$query = 'select '.$this->select.' from tb_pecas';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}
};