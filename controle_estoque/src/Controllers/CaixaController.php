<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use src\Models\CaixasEntity;

class CaixaController extends Action {

	public function index()
	{	
		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_caixa', 'Cadastrar nova caixa', 'layout-base-inserts');
	}

    public function novaCaixa()
	{	
		try {
			$caixa = Container::getModel('CaixasDAO');

			$obj = new CaixasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdCaixa(preg_replace('/[^a-z0-9]/i', '', $_POST['idCaixa']));
			$obj->setNomeCaixa($_POST['nomeCaixa']);
			$obj->setCorCaixa($_POST['corCaixa']);
			$obj->setDescricaoCaixa($_POST['descricaoCaixa']);

			$resultado_operacao = $caixa->insert($obj);

			if($resultado_operacao == 1) {

				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdCaixa());
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdCaixa());
				throw new Exception('Erro ao lançar nova Caixa. Verifique se o ID da Caixa já está cadastrado.');
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function todasCaixas()
	{
		$operacao = lcfirst($_GET['operacao']);

		$caixa = Container::getModel('CaixasDAO');

		$caixas = $caixa->selectCaixas();

		$this->matrizDataToView($caixas);

		//página miolo (conteudo do modal), titulo da pagina, tipo dos botões
		$this->renderModal('todas_caixas', 'Lista Caixas Ativas', $operacao);
	}

	public function deletarCaixa()
	{
		try {
			$caixas_excluir = $_POST['caixa'];
	
			$caixa = Container::getModel('CaixasDAO');
	
			$resultado_operacao = $caixa->deletar($caixas_excluir);

			if($resultado_operacao == count($caixas_excluir)) {
				$resposta = array('resultado_operacao' => true, 'ids_operacao' => $caixas_excluir);
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'ids_operacao' => $caixas_excluir);
				throw new Exception('Erro ao deletar peça(s).');
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function prepararCaixa()
	{
		$peca = Container::getModel('PecasDAO');

		$operacao = 'confirmar-editar';

		try {
			$id_caixa = $_POST['caixa'][0];
	
			$caixa = Container::getModel('CaixasDAO');

			$caixa_editar = $caixa->selectCaixa($id_caixa);

			$this->view->disabled = false;
			if($peca->vericarCaixaEmUso($id_caixa)) $this->view->disabled = true;

			$this->arrayDataToView($caixa_editar[0]);

			$this->renderModal('editar_caixa', 'Editar caixa ID '. $id_caixa, $operacao);
	
			if(!$caixa_editar) throw new Exception('Erro ao deletar caixa(s).');
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function editarCaixa()
	{	
		try {
			$caixa = Container::getModel('CaixasDAO');

			$obj = new CaixasEntity();

			$id_caixa = $_POST['idCaixa'] ?? $_POST['oldId'];

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
			$e->getMessage();
			echo json_encode($resposta);
		}
	}
}