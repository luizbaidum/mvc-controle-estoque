<?php

namespace src\Models;

use MF\Model\Model;

class CaixasDAO extends Model {

	function insert($obj)
	{
		$query = "INSERT INTO `caixas` (`idCaixa`, `nomeCaixa`, `corCaixa`, `descricaoCaixa`) VALUES (".$obj->getIdCaixa().", '".$obj->getNomeCaixa()."', '".$obj->getCorCaixa()."', '".$obj->getDescricaoCaixa()."')";

		$result = $this->db->exec($query);

		return $result;
	}
}