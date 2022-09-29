<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use src\Helpers\NumbersHelper;
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
			$obj->setQtdPeca($_POST['caixaPeca']);
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
}