<?php

namespace src\Models;

use MF\Model\Model;

class CaixasDAO extends Model {

	function insert($obj)
	{
		$query = "INSERT INTO `caixas` (`idCaixa`, `nomeCaixa`, `corCaixa`, `descricaoCaixa`, `dataHora`) VALUES (".$obj->getIdCaixa().", '".$obj->getNomeCaixa()."', '".$obj->getCorCaixa()."', '".$obj->getDescricaoCaixa()."', '".$this->getTime()."')";

		$result = $this->db->exec($query);

		return $result;
	}

	function selectCaixa($id)
	{
		$query = "SELECT `idCaixa`, `nomeCaixa`, `corCaixa`, `descricaoCaixa` FROM `caixas` WHERE `idCaixa` = $id";

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}

	function selectCaixas()
	{
		$query = "SELECT `idCaixa`, `nomeCaixa` FROM `caixas`";

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}

	function deletar($caixas_excluir)
	{
		$id_caixa = implode(" ", $caixas_excluir);

		$query = "DELETE FROM `caixas` WHERE `caixas`.`idCaixa` IN (".str_replace(' ', ', ', $id_caixa).");";

		$result = $this->db->exec($query);

		return $result;
	}

	function editar($obj)
	{
		$query = "UPDATE `caixas` SET `idCaixa` = ".$obj->getIdCaixa().", `nomeCaixa` = '".$obj->getNomeCaixa()."', `corCaixa` = '".$obj->getCorCaixa()."', `descricaoCaixa` = '".$obj->getDescricaoCaixa()."', `dataHora` = '".$this->getTime()."' WHERE `idCaixa` = ".$obj->getOldId()."";

		$result = $this->db->exec($query);
		
		return $result;
	}
}