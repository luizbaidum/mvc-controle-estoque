<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	//não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'idPeca,nomePeca,vlrCompraPeca,qtdPeca,caixaPeca';

	private $join = 'caixas.idCaixa,caixas.nomeCaixa';

	public function getPecas()
	{
		$query = 'SELECT '.$this->select.', '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

	public function getPecasPesquisa($coluna, $item)
	{
		$query = 'SELECT '.$this->select.', '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa WHERE '.$coluna.' LIKE "%'.$item.'%"';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

	function selectPeca($id)
	{
		$query = 'SELECT '.$this->select.' FROM `pecas` WHERE `idPeca` = '.$id;

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

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

	function editar($obj)
	{
		$query = "UPDATE `pecas` SET `idPeca` = ".$obj->getIdPeca().", `nomePeca` = '".$obj->getNomePeca()."', `vlrCompraPeca` = ".$obj->getVlrCompraPeca().",  `qtdPeca` = ".$obj->getQtdPeca().", `caixaPeca` = ".$obj->getCaixaPeca().", `dataHora` = '".$this->getTime()."' WHERE `idPeca` = ".$obj->getOldId()."";

		$result = $this->db->exec($query);
		
		return $result;
	}

	function selectWithOrdenation($variaveis)
	{
		$order_by = $variaveis["order_by"];

		if($variaveis['pesquisa_item'] != '' && $variaveis['pesquisa_obj'] != '') {
			
			$coluna = explode("-", $variaveis['pesquisa_item']);
			$item = $variaveis['pesquisa_obj'];

			$query = 'SELECT '.$this->select.', '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa WHERE '.$coluna[1].' LIKE "%'.$item.'%"';
		} else {

			$query = 'SELECT '.$this->select.', '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa';
		}

		$query .= ' ORDER BY '.$order_by.' ASC';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

	function baixarQtdPeca($obj)
	{
		$query = "SELECT `qtdPeca` FROM `pecas` WHERE `idPeca` = ".$obj->getIdPeca()."; ".
				"UPDATE `pecas` SET `qtdPeca` = qtdPeca - ".$obj->getQtdUso()." WHERE `idPeca` = ".$obj->getIdPeca().";";
	
		$result = $this->db->query($query)->fetch(\PDO::FETCH_OBJ);
		
		return $result;
	}
};