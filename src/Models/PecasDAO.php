<?php

namespace src\Models;

use MF\Model\Model;

class PecasDAO extends Model {

	//não pode ter espaço para não complicar as tags do button 'Ordenar'
	public $select = 'idPeca,nomePeca,vlrCompraPeca,qtdPeca,caixaPeca';

	private $join = 'caixas.idCaixa,caixas.nomeCaixa';

	public function getPecas()
	{
		$query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

	public function getPecasPesquisa($coluna, $item)
	{
		$query = 'SELECT '.$this->select.',fotoPeca, '.$this->join.' FROM pecas INNER JOIN caixas ON pecas.caixaPeca = caixas.idCaixa WHERE '.$coluna.' LIKE "%'.$item.'%"';

	 	$result = $this->db->query($query)->fetchAll(\PDO::FETCH_OBJ);

		return $result;
	}

	function selectPeca($id)
	{
		$query = 'SELECT '.$this->select.',fotoPeca FROM `pecas` WHERE `idPeca` = '.$id;

		$result = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}

	function insert($obj)
	{
		$script_imagem = NULL;
		if ($obj->getFotoPeca() != NULL) {
			$script_imagem = ", `fotoPeca` = '".$obj->getFotoPeca()."',";
		}

		$query = "INSERT INTO `pecas` (`idPeca`, `nomePeca`, `vlrCompraPeca`, `qtdPeca`,`caixaPeca`, `fotoPeca`, `dataHora`) VALUES (".$obj->getIdPeca().", '".$obj->getNomePeca()."', '".$obj->getVlrCompraPeca()."', '".$obj->getQtdPeca()."','".$obj->getCaixaPeca()."', ".$script_imagem.", '".$this->getTime()."')";

		$result = $this->db->exec($query);

		return $result;
	}

	function deletar($pecas_excluir)
	{
		$id_peca = implode(" ", $pecas_excluir);

		$query = "DELETE `pecas`.* FROM `pecas` WHERE `pecas`.`idPeca` IN (".str_replace(' ', ', ', $id_peca).");";

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
		$script_imagem = ',';
		if ($obj->getFotoPeca() != NULL) {
			$script_imagem = ", `fotoPeca` = '".$obj->getFotoPeca()."',";
		}

		$query = "UPDATE `pecas` SET `idPeca` = ".$obj->getIdPeca().", `nomePeca` = '".$obj->getNomePeca()."', `vlrCompraPeca` = ".$obj->getVlrCompraPeca().",  `qtdPeca` = ".$obj->getQtdPeca().", `caixaPeca` = ".$obj->getCaixaPeca()." ".$script_imagem." `dataHora` = '".$this->getTime()."' WHERE `idPeca` = ".$obj->getOldId()."";

		$result = $this->db->exec($query);
		
		return $result;
	}

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
		$diretorio = "C:\Users\Luiz\Desktop\miniframework-2\mvc-controle-estoque\src\Imagens\\".$obj->getIdPeca()."\\";

		if (!file_exists($diretorio)) {
			mkdir($diretorio, 0755);
		}
	
		if(move_uploaded_file($_FILES['fotoPeca']['tmp_name'], $diretorio . $obj->getFotoPeca()));
			return true;

		return false;
	}

	public function load_img($id_peca, $foto)
	{
		$diretorio = "C:\Users\Luiz\Desktop\miniframework-2\mvc-controle-estoque\src\Imagens\\".$id_peca."\\";

		$carregar = $diretorio . $foto;

		return $carregar;
	}

	public function delete_img_bd($id_peca)
	{
		$query = "UPDATE `pecas` SET `fotoPeca` = NULL WHERE `idPeca` = ".$id_peca.";";
				
		$result = $this->db->exec($query);
		
		return $result;
	}
};