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

	function selectCaixas()
	{
		$query = "SELECT `idCaixa`, `nomeCaixa` FROM `caixas`";

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}
}