<?php

namespace src\Models;

use MF\Model\Model;

class CaixasDAO extends Model {

	function insert($obj)
	{
		try {
			$query = "INSERT INTO `caixas` (`nomeCaixa`, `corCaixa`, `descricaoCaixa`, `dataHora`) 
							VALUES (:nome, :cor, :descricao, :data_insert)";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':nome', $obj->getNomeCaixa());
			$stmt->bindValue(':cor', $obj->getCorCaixa());
			$stmt->bindValue(':descricao', $obj->getDescricaoCaixa());
			$stmt->bindValue(':data_insert', $this->getTime());

			$result = $stmt->execute();

			if ($result) {
                $lastId = $this->db->lastInsertId();
                return $lastId;
            } else {
                return false;
            }
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	function selectCaixa($id)
	{
		try {
			$query = "SELECT `idCaixa`, `nomeCaixa`, `corCaixa`, `descricaoCaixa` 
				FROM `caixas` 
				WHERE `idCaixa` = :id";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id', $id);

			$stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return [];
		}
	}

	function selectCaixas()
	{
		try {
			$query = "SELECT `idCaixa`, `nomeCaixa` FROM `caixas`";

			$stmt = $this->db->prepare($query);

			$stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return [];
		}
	}

	function deletar($caixas_excluir)
	{
		try {
			$id_caixa = implode(" ", $caixas_excluir);

			$query = "DELETE FROM `caixas` 
				WHERE `caixas`.`idCaixa` IN (:ids_caixas);";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':ids_caixas', str_replace(' ', ', ', $id_caixa));

			$result = $stmt->execute();
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	function editar($obj)
	{
		try {
			$query = "UPDATE `caixas` SET
				`nomeCaixa` = :nome,
				`corCaixa` = :cor,
				`descricaoCaixa` = :descricao,
				`dataHora` = :data_insert
				WHERE `idCaixa` = :old_id";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':nome', $obj->getNomeCaixa(), \PDO::PARAM_STR);
			$stmt->bindValue(':cor', $obj->getCorCaixa(), \PDO::PARAM_STR);
			$stmt->bindValue(':descricao', $obj->getDescricaoCaixa(), \PDO::PARAM_STR);
			$stmt->bindValue(':data_insert', $this->getTime(), \PDO::PARAM_STR);
			$stmt->bindValue(':old_id', $obj->getOldId(), \PDO::PARAM_STR);

			$result = $stmt->execute();

			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}
}