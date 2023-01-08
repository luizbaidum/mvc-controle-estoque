<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	//não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'idPeca,nomePeca,vlrCompraPeca,qtdPeca,caixaPeca';

	private $join = 'caixas.idCaixa,caixas.nomeCaixa';

	public function getPecas()
	{
		$query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' 
				FROM pecas 
				INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa';

		$stmt = $this->db->prepare($query);

		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $result;
	}

	public function getPecasPesquisa($coluna, $item)
	{
		$query = "SELECT $this->select,fotoPeca, $this->join 
				FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa 
				WHERE $coluna LIKE :item";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':item', "%".$item."%");

		$stmt->execute();
	 	$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $result;
	}

	function selectPeca($id)
	{
		$query = 'SELECT '.$this->select.',fotoPeca 
					FROM `pecas` 
					WHERE `idPeca` = :id';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);

		$stmt->execute();
	 	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	function insert($obj)
	{
		$script_imagem = ', ';
		$foto_peca = ', ';
		if ($obj->getFotoPeca() != NULL) {
			$script_imagem = ",'".$obj->getFotoPeca()."',";
			$foto_peca = ", `fotoPeca`,";
		}

		$query = "INSERT INTO `pecas` (`idPeca`, `nomePeca`, `vlrCompraPeca`, `qtdPeca`,`caixaPeca`".$foto_peca." `dataHora`) 
			VALUES (:id, :nome, :valor, :qtd,:caixa".$script_imagem.":data_hora)";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $obj->getIdPeca());
		$stmt->bindValue(':nome', $obj->getNomePeca());
		$stmt->bindValue(':valor', $obj->getVlrCompraPeca());
		$stmt->bindValue(':qtd', $obj->getQtdPeca());
		$stmt->bindValue(':caixa', $obj->getCaixaPeca());
		$stmt->bindValue(':data_hora', $this->getTime());

		$result = $stmt->execute();
		return $result;
	}

	function deletar($pecas_excluir)
	{
		$id_peca = implode(", ", $pecas_excluir);

		$query = "DELETE `pecas`.* FROM `pecas` WHERE `pecas`.`idPeca` IN (:id_peca);";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_peca', $id_peca);

		$result = $stmt->execute();
		return $result;
	}

	function vericarCaixaEmUso($id_caixa)
	{
		$query = 'SELECT `idPeca` FROM `pecas` WHERE `caixaPeca` = :id_caixa';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_caixa', $id_caixa);

		$result = $stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if($result)
			return true;
		else
			return false;
	}

	function editar($obj)
	{
		$script_imagem = ',';
		if ($obj->getFotoPeca() != NULL) {
			$script_imagem = ", `fotoPeca` = '".$obj->getFotoPeca()."',";
		}

		$query = "UPDATE `pecas` SET 
			`idPeca` = :id, 
			`nomePeca` = :nome, 
			`vlrCompraPeca` = :valor, 
			`qtdPeca` = :qtd, 
			`caixaPeca` = :caixa 
			".$script_imagem." 
			`dataHora` = :data_hora 
			WHERE `idPeca` = :old_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':old_id', $obj->getOldId());
		$stmt->bindValue(':id', $obj->getIdPeca());
		$stmt->bindValue(':nome', $obj->getNomePeca());
		$stmt->bindValue(':valor', $obj->getVlrCompraPeca());
		$stmt->bindValue(':qtd', $obj->getQtdPeca());
		$stmt->bindValue(':caixa', $obj->getCaixaPeca());
		$stmt->bindValue(':data_hora', $this->getTime());

		$result = $stmt->execute();	
		return $result;
	}
//continuar a partir daqui
	function selectWithOrdenation($variaveis)
	{
		$order_by = $variaveis["order_by"];

		if($variaveis['pesquisa_item'] != '' && $variaveis['pesquisa_obj'] != '') {
			
			$coluna = explode("-", $variaveis['pesquisa_item']);
			$item = $variaveis['pesquisa_obj'];

			$query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa WHERE '.$coluna[1].' LIKE "%'.$item.'%"';
		} else {

			$query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa';
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

	public function upload_img($obj)
	{
		$diretorio = "C:\Users\Acer\Desktop\GITHUB\mvc-controle-estoque\public\img/".$obj->getIdPeca()."/";
		
		if (!file_exists($diretorio))
			mkdir($diretorio, 0755);

		$destino = $diretorio.$obj->getFotoPeca();
	
		if(move_uploaded_file($_FILES['fotoPeca']['tmp_name'], $destino))
			return true;

		return false;
	}

	public function load_img($id_peca, $foto)
	{
		$diretorio = "IMG/".$id_peca."/";

		$carregar = $diretorio.$foto;

		return $carregar;
	}

	public function delete_img_bd($id_peca)
	{
		$query = "UPDATE `pecas` SET `fotoPeca` = NULL WHERE `idPeca` = ".$id_peca.";";
				
		$result = $this->db->exec($query);
		
		return $result;
	}
};