<?php 

namespace src\Models;

use MF\Model\Model;

class UsoPecaDAO extends Model {

    function insertUso($obj)
    {
        $query = "INSERT INTO `uso_pecas` (`idPeca`, `qtdUso`, `motivoUso`, `dataUso`, `dataHora`) 
				  VALUES (:id, :qtd, :motivo, :data_uso, :data_hora)";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $obj->getIdPeca());
		$stmt->bindValue(':qtd', $obj->getQtdUso());
		$stmt->bindValue(':motivo', $obj->getMotivoUso());
		$stmt->bindValue(':data_uso', $obj->getDataUso());
		$stmt->bindValue(':data_hora', $this->getTime());

		$result = $stmt->execute();
		return $result;
    }

    function vericarPecaEmUso($id_peca)
	{
		$query = 'SELECT `idUso` FROM `uso_pecas` WHERE `idPeca` = :id';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id_peca);

		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if(count($result) > 0)
			return true;
		else
			return false;
	}
}; 