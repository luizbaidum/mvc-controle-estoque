<?php 

namespace src\Models;

use MF\Model\Model;

class UsoPecaDAO extends Model {

    function insertUso($obj)
    {
        $query = "INSERT INTO `uso_pecas` (`idPeca`, `qtdUso`, `dataUso`, `dataHora`) VALUES (".$obj->getIdPeca().", '".$obj->getQtdUso()."', '".$obj->getDataUso()."', '".$this->getTime()."')";

		$result = $this->db->exec($query);

        return $result;
    }
}; 