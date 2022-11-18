<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use MF\ViewHelper\NumbersHelper;
use src\Models\PecasEntity;
use src\Models\UsoPecaEntity;

class PecaController extends Action {

	public function index()
	{	
		$model_caixa = Container::getModel('CaixasDAO');
		$lista_caixas = $model_caixa->selectCaixas();

		$this->matrizDataToView($lista_caixas);

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_peca', 'Cadastrar nova peça', 'layout-base-inserts');
	}

    public function novaPeca()
	{	
		try {
			$model_peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$obj->setVlrCompraPeca(NumbersHelper::formatMoney($_POST['vlrCompraPeca']));
			$obj->setQtdPeca($_POST['qtdPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			$foto_peca = NULL;
			if($_FILES['fotoPeca']['name'] != '')
				$foto_peca = $this->limparCaracteres($_FILES['fotoPeca']['name']);
				$foto_peca = substr_replace($foto_peca, '.', -3, 0);

			$obj->setFotoPeca($foto_peca);

			$resultado_operacao = $model_peca->insert($obj);

			$resultado_upload = 1;

			if($resultado_operacao == 1 && $foto_peca != NULL)
				$resultado_upload = $model_peca->upload_img($obj);

			if($resultado_operacao != 1 || $resultado_upload != 1) {

				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdPeca());
				throw new Exception('Erro ao lançar nova Peça. Verifique se o ID da Peça já está cadastrado.');
			} else {
				
				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdPeca());
				echo json_encode($resposta);
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
	
			$model_peca = Container::getModel('PecasDAO');
	
			$resultado_operacao = $model_peca->deletar($pecas_excluir);

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
			$model_peca = Container::getModel('PecasDAO');
			$model_caixa = Container::getModel('CaixasDAO');
			$model_uso = Container::getModel('UsoPecaDAO');

			$id_peca = $_POST['idPeca'][0];
			$lista_caixas = $model_caixa->selectCaixas();

			$peca_editar = $model_peca->selectPeca($id_peca);

			$this->view->disabled = false;
			if($model_uso->vericarPecaEmUso($id_peca)) $this->view->disabled = true;

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
		try {
			$model_peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$obj->setVlrCompraPeca(NumbersHelper::formatMoney($_POST['vlrCompraPeca']));
			$obj->setQtdPeca($_POST['qtdPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);
			$obj->setOldId($_POST['oldId']);

			$resultado_operacao = $model_peca->editar($obj);

			if($resultado_operacao == 1) {

				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdPeca());
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdPeca());
				throw new Exception('Erro ao editar Peça.');
			}

		} catch (Exception $e) {
			echo json_encode($resposta);
			$e->getMessage();
		}
	}

	public function prepararBaixa()
	{	
		try {
			$model_peca = Container::getModel('PecasDAO');

			foreach($_GET['idPeca'] as $id) {
				$pecas[] = $model_peca->selectPeca($id);
			}

			if(count($pecas) > 0) {
				$this->matrizDataToView($pecas);
				$this->render('baixar_peca', 'Baixar peça(s)', 'layout-base-inserts');
			} else {
				throw new Exception('Erro ao selecionar peça(s) para baixa.');
			}
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function baixarPeca()
	{	
		try {
			$model_uso = Container::getModel('UsoPecaDAO');
			$model_peca = Container::getModel('PecasDAO');

			foreach($_POST['idPeca'] as $k => $peca_baixar) {

				$obj = new UsoPecaEntity();

				$obj->setIdPeca($peca_baixar);
				$obj->setQtdUso($_POST['qtdUso'][$k]);
				$obj->setMotivoUso($_POST['motivoUso'][$k]);
				$obj->setDataUso($_POST['dataUso'][$k]);

				$baixa = $model_uso->insertUso($obj);

				$abatimento = $model_peca->baixarQtdPeca($obj);
				
				if($baixa != '1' || $abatimento == false) {
					$resultado_final = false;
				} else {
					$resultado_final = true;
				}
					
				$ids_sucesso[] = $obj->getIdPeca();
			};

			if($resultado_final == true) {
				$resposta = array('resultado_operacao' => true, 'id_operacao' => $ids_sucesso);
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $ids_sucesso);
				throw new Exception('Erro no precesso de baixar Peça(s).');
			}
		} catch (Exception $e) {
			echo json_encode($resposta);
			$e->getMessage();
		}
	}

	public function carregarFotoPeca()
	{
		try {
			$diretorio = "C:\Users\Luiz\Desktop\miniframework-2\mvc-controle-estoque\src\Imagens\\".$_POST['peca']."\\";

			$abrir_foto = $diretorio . $_POST['foto'];

			$this->renderModal('foto_peca', $_POST["peca"], $abrir_foto);
		} catch (Exception $e) {
			$e->getMessage();
		}
	}
}