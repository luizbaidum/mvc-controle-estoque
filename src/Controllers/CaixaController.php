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
			$obj->setIdCaixa($_POST['idCaixa']);
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

			echo json_encode($resposta);
			$e->getMessage();
		}
	}

	public function exibirCaixas()
	{
		$caixa = Container::getModel('CaixasDAO');

		$caixas = $caixa->selectCaixas();

		$this->title = 'Teste titulo';

		$this->matrizDataToView($caixas);

		//página miolo (conteudo do modal), titulo da pagina, tipo dos botões
		$this->renderModal('todas_caixas', 'Lista Caixas Ativas', 'deletar');
		//quero dar mais coisas p/ essa função pq ela tá muito simples, talvez passar o $define dos buttos aqui dentro e por sua vez os buttons acionados no base modal
	}
}