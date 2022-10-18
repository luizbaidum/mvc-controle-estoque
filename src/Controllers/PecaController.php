<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use MF\ViewHelper\NumbersHelper;
use src\Models\PecasEntity;

class PecaController extends Action {

	public function index()
	{	
		$caixa = Container::getModel('CaixasDAO');
		$lista_caixas = $caixa->selectCaixas();

		$this->matrizDataToView($lista_caixas);

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_peca', 'Cadastrar nova peça', 'layout-base-inserts');
	}

    public function novaPeca()
	{	
		try {
			$peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$obj->setVlrCompraPeca(NumbersHelper::formatMoney($_POST['vlrCompraPeca']));
			$obj->setQtdPeca($_POST['qtdPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			$resultado_operacao = $peca->insert($obj);

			if($resultado_operacao == 1) {

				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdPeca());
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdPeca());
				throw new Exception('Erro ao lançar nova Peça. Verifique se o ID da Peça já está cadastrado.');
			}

		} catch (Exception $e) {

			echo json_encode($resposta);
			$e->getMessage();
		}
	}

	public function deletarPeca()
	{
		try {
			$pecas_excluir = $_POST['idPeca'];
	
			$peca = Container::getModel('PecasDAO');
	
			$resultado_operacao = $peca->deletar($pecas_excluir);

			if($resultado_operacao == count($pecas_excluir)) {
				$resposta = array('resultado_operacao' => true, 'ids_operacao' => $pecas_excluir);
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'ids_operacao' => $pecas_excluir);
				throw new Exception('Erro ao deletar peça(s).');
			}
		} catch (Exception $e) {

			echo json_encode($resposta);
			$e->getMessage();
		}
	}

	public function prepararEditarPeca()
	{
		try {	
			$peca = Container::getModel('PecasDAO');
			$caixa = Container::getModel('CaixasDAO');

			$id_peca = $_POST['idPeca'][0];
			$lista_caixas = $caixa->selectCaixas();

			$peca_editar = $peca->selectPeca($id_peca);

			$this->arrayDataToView($peca_editar[0]);

			$this->matrizDataToView($lista_caixas);
			
			$this->render('editar_peca', 'Editar peça ID: '.$id_peca, 'layout-base-inserts');

			if(!$peca_editar || !$lista_caixas) throw new Exception('Erro ao carregar peça para edição.');

		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function editarPeca()
	{	
		try { //terminar de criar esta function
			$peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			$id_caixa = $_POST['idCaixa'] ?? $_POST['oldId']; //fazer isso na view

			$obj->setIdCaixa($id_caixa);
			$obj->setNomeCaixa($_POST['nomeCaixa']);
			$obj->setCorCaixa($_POST['corCaixa']);
			$obj->setDescricaoCaixa($_POST['descricaoCaixa']);
			$obj->setOldId($_POST['oldId']);

			$resultado_operacao = $caixa->editar($obj);

			if($resultado_operacao == 1) {

				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdCaixa());
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdCaixa());
				throw new Exception('Erro ao editar Caixa.');
			}

		} catch (Exception $e) {

			echo json_encode($resposta);
			$e->getMessage();
		}
	}
}