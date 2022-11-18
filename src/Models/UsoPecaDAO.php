<?php 

namespace src\Models;

use MF\Model\Model;

class UsoPecaDAO extends Model {

    function insertUso($obj)
    {
        $query = "INSERT INTO `uso_pecas` (`idPeca`, `qtdUso`, `motivoUso`, `dataUso`, `dataHora`) VALUES (".$obj->getIdPeca().", '".$obj->getQtdUso()."', '".$obj->getMotivoUso()."','".$obj->getDataUso()."', '".$this->getTime()."')";

		$result = $this->db->exec($query);

        return $result;
    }

    function vericarPecaEmUso($id_peca)
	{
		$query = 'SELECT `idUso` FROM `uso_pecas` WHERE `idPeca` = '.$id_peca.'';

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);;

		if($result)
			return true;
		else
			return false;
	}
}; 