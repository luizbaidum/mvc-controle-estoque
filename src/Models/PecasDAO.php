<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	//não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'idPeca,nomePeca,vlrCompraPeca,caixaPeca';

	private $join = 'caixas.nomeCaixa';

	public function getPecas()
	{
		$query = 'select '.$this->select.', '.$this->join.' FROM pecas INNER JOIN caixas WHERE caixaPeca = caixas.idCaixa';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);	

		return $result;
	}
};