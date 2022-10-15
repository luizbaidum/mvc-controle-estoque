<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	//não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'idPeca,nomePeca,vlrCompraPeca,qtdPeca,caixaPeca';

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

	function deletar($pecas_excluir)
	{
		$id_peca = implode(" ", $pecas_excluir);

		$query = "DELETE FROM `pecas` WHERE `pecas`.`idPeca` IN (".str_replace(' ', ', ', $id_peca).");";

		$result = $this->db->exec($query);

		return $result;
	}

	function vericarCaixaEmUso($id_caixa)
	{
		$query = 'SELECT `idPeca` FROM `pecas` WHERE `caixaPeca` = '.$id_caixa.'';

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);;

		if($result)
			return true;
		else
			return false;
	}
};