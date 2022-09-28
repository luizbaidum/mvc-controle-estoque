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

	function insert($obj)
	{
		$query = "INSERT INTO `pecas` (`idPeca`, `nomePeca`, `vlrCompraPeca`, `qtdPeca`,`caixaPeca`, `dataHora`) VALUES (".$obj->getIdPeca().", '".$obj->getNomePeca()."', '".$obj->getVlrCompraPeca()."', '".$obj->getQtdPeca()."','".$obj->getCaixaPeca()."', '".$this->getTime()."')";

		$result = $this->db->exec($query);

		return $result;
	}

	function deletar($peca)
	{
		$query = "DELETE FROM `pecas` WHERE `pecas`.`idPeca` = $peca;";

		$result = $this->db->exec($query);

		return $result;
	}
};