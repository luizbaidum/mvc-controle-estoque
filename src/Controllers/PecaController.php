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
			$processo_finalizado = 'processo_iniciado';

			$obj = new PecasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$obj->setVlrCompraPeca(NumbersHelper::formatMoney($_POST['vlrCompraPeca']));
			$obj->setQtdPeca($_POST['caixaPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			if($peca->insert($obj) == true) {

				$processo_finalizado = true;
				echo $processo_finalizado;
			} else {

				throw new Exception('Erro ao lançar nova Peça. Verifique se o ID da Peça já está cadastrado.');
			}

		} catch (Exception $e) {

			$processo_finalizado = false;
			echo $processo_finalizado;
			echo $e->getMessage();
		}
	}

	public function deletarPeca()
	{
		$pecas_excluir = $_POST['idPeca'];

		foreach($pecas_excluir as $id) {
	
			$peca = Container::getModel('PecasDAO');

			$peca->deletar($id);
		}
	}
}