<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	// não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'pecas.idPeca,pecas.nomePeca,pecas.vlrCompraPeca,pecas.qtdPeca,pecas.idCaixa';

	private $join = 'caixas.idCaixa,caixas.nomeCaixa';

	public function getPecas()
	{
        try {
            $query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' 
				FROM pecas
				INNER JOIN caixas ON pecas.idCaixa = caixas.idCaixa';

            $stmt = $this->db->prepare($query);

            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\Exception $e) {
            echo "Error occurred: " . $e->getMessage();
            return [];
        }
	}

	public function getPecasPesquisa($coluna, $item)
	{
		try {
			$query = "SELECT $this->select,fotoPeca, $this->join 
				FROM pecas INNER JOIN caixas ON pecas.idCaixa = caixas.idCaixa 
				WHERE $coluna LIKE :item";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':item', "%".$item."%");

			$stmt->execute();
	 		$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return [];
		}
	}

	function selectPeca($id)
	{
		try {
			$query = 'SELECT '.$this->select.',fotoPeca 
				FROM `pecas` 
				WHERE `idPeca` = :id';

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id', $id);

			$stmt->execute();
	 		$result = $stmt->fetch(\PDO::FETCH_ASSOC);

			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return [];
		}
	}

	function insert($obj)
	{
		try {
			$script_imagem = ', ';
			$foto_peca = ', ';
			if ($obj->getFotoPeca() != NULL) {
				$script_imagem = ",'".$obj->getFotoPeca()."',";
				$foto_peca = ", `fotoPeca`,";
			}

			$query = "INSERT INTO `pecas` (`nomePeca`, `vlrCompraPeca`, `qtdPeca`,`idCaixa` ".$foto_peca." `dataHora`) 
				VALUES (:nomePeca, :vlrCompraPeca, :qtdPecad,:idCaixa".$script_imagem.":dataHora)";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':nomePeca', $obj->getNomePeca());
			$stmt->bindValue(':vlrCompraPeca', $obj->getVlrCompraPeca());
			$stmt->bindValue(':qtdPecad', $obj->getQtdPeca());
			$stmt->bindValue(':idCaixa', $obj->getIdCaixa());
			$stmt->bindValue(':dataHora', $this->getTime());

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

	function deletar($pecas_excluir)
	{
		try {
			$ids_where = "";
			foreach($pecas_excluir as $v) {
				$ids_where .= " $v,";
			}
			$ids_where = rtrim($ids_where, ",");

			$query = "DELETE `pecas`.* FROM `pecas` WHERE `pecas`.`idPeca` IN ($ids_where);";

			$stmt = $this->db->prepare($query);

			$result = $stmt->execute();
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	function vericarCaixaEmUso($id_caixa)
	{
		try {
			$query = 'SELECT `idPeca` FROM `pecas` WHERE `idCaixa` = :id_caixa';

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_caixa', $id_caixa);

			$result = $stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if($result)
				return true;
			else
				return false;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	function editar($obj)
	{
		try {
			$script_imagem = ',';
			if ($obj->getFotoPeca() != NULL) {
				$script_imagem = ", `fotoPeca` = '".$obj->getFotoPeca()."',";
			}

			$query = "UPDATE `pecas` SET 
				`nomePeca` = :nome, 
				`vlrCompraPeca` = :valor, 
				`qtdPeca` = :qtd, 
				`idCaixa` = :caixa 
				".$script_imagem." 
				`dataHora` = :data_hora 
				WHERE `idPeca` = :old_id";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':old_id', $obj->getOldId());
			$stmt->bindValue(':nome', $obj->getNomePeca());
			$stmt->bindValue(':valor', $obj->getVlrCompraPeca());
			$stmt->bindValue(':qtd', $obj->getQtdPeca());
			$stmt->bindValue(':caixa', $obj->getIdCaixa());
			$stmt->bindValue(':data_hora', $this->getTime());

			$result = $stmt->execute(); 
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	function selectWithOrdenation($variaveis)
	{
		try {
			$order_by = $variaveis["order_by"];

			if ($variaveis['pesquisa_item'] != '' && $variaveis['pesquisa_obj'] != '') {

				$coluna = explode("-", $variaveis['pesquisa_item']);
				$item = "%".$variaveis['pesquisa_obj']."%";

				$query = "SELECT ".$this->select.", fotoPeca, ".$this->join." FROM pecas INNER JOIN caixas ON pecas.idCaixa = caixas.idCaixa WHERE ".$coluna[1]." LIKE :obj_busca";
			} else {
				$query = "SELECT ".$this->select.", fotoPeca, ".$this->join." FROM pecas INNER JOIN caixas ON pecas.idCaixa = caixas.idCaixa";
			}

			$query .= " ORDER BY $order_by ASC";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':obj_busca', $item ?? '');

			$stmt->execute(); 
			$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return [];
		}
	}

	function baixarQtdPeca($obj)
	{
		try {
			$query = "UPDATE `pecas` SET `qtdPeca` = qtdPeca - :qtd_uso WHERE `idPeca` = :obj_busca";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':obj_busca', $obj->getIdPeca(), \PDO::PARAM_INT);
			$stmt->bindValue(':qtd_uso', $obj->getQtdUso(), \PDO::PARAM_INT);

			$result = $stmt->execute();
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	public function upload_img($obj)
	{
		try {
			$parte_dir = preg_replace('/[^A-Za-z0-9\-]/', '', $obj->getIdPeca());
			$diretorio = "C:\Users\Luiz\Desktop\GITHUB\mvc-controle-estoque\public\img/".$parte_dir."/";

			if (!file_exists($diretorio))
				mkdir($diretorio, 0755);

			$destino = $diretorio.$obj->getFotoPeca();

			if (move_uploaded_file($_FILES['fotoPeca']['tmp_name'], $destino))
				return true;

			return false;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	public function load_img($id_peca, $foto)
	{
		try {
			$id_peca = preg_replace('/[^A-Za-z0-9\-]/', '', $id_peca);
			$diretorio = "IMG/".$id_peca."/";

			$carregar = $diretorio.$foto;

			return $carregar;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}

	public function delete_img_bd($id_peca)
	{
		try {
			$query = "UPDATE `pecas` SET `fotoPeca` = NULL WHERE `idPeca` = :id_peca";

			$stmt = $this->db->prepare($query);

			$stmt->bindValue(':id_peca', $id_peca, \PDO::PARAM_INT); 
			$result = $stmt->execute(); 
			return $result;
		} catch (\Exception $e) {
			echo "Error occurred: " . $e->getMessage();
			return false;
		}
	}
};