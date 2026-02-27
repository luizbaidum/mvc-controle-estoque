<?php

namespace MF\ViewHelper;

class Buttons {

    public static function buttonsMenu()
    {
        $buttons_menu = [
            "novo" => '<span><button class="buttons_menu dropdown-toggle btn" type="button" id="dropdown-novo" data-toggle="dropdown" aria-haspopup="true">
                        Novo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-novo">
                        <a class="dropdown-item" href="/nova_peca">Peça</a>
                        <a class="dropdown-item" href="/nova_caixa">Caixa</a>
                    </div></span>',
            "baixar" => '<button id="baixar" class="buttons_menu btn">Baixar/Uso</button>',
            "apagar" => '<span><button class="buttons_menu dropdown-toggle btn" type="button" id="dropdown-apagar" data-toggle="dropdown" aria-haspopup="true">Apagar</button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-apagar">
                            <button class="dropdown-item" id="del-peca">Peça</button>
                            <button class="dropdown-item listar-caixas">Caixa</button>
                        </div></span>',
            "editar" => '<span><button class="buttons_menu dropdown-toggle btn" type="button" id="dropdown-editar" data-toggle="dropdown" aria-haspopup="true">Editar</button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-editar">
                            <button class="dropdown-item" id="prepara-edit-peca">Peça</button>
                            <button class="dropdown-item listar-caixas">Caixa</button>
                        </div></span>',
            "relatorio" => '<span>
                                <button class="buttons_menu dropdown-toggle btn" type="button" id="dropdown-relatorio" data-toggle="dropdown" aria-haspopup="true">Relatório</button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-relatorio">
                                    <a class="dropdown-item" href="/relatorio_uso">Uso</a>
                                </div>
                            </span>',
        ];
        return $buttons_menu;
    }

    public static function buttonsCrud()
    {
        $buttons_crud = [
            "salvar" => '<button id="salvar" type="button" class="buttons_crud">Salvar</button>',
			"cancelar" => '<button id="cancelar" class="buttons_crud" type="button">Cancelar/Voltar</button>',
        ];
        return $buttons_crud;
    }

    public static function buttonsOrdenar($option_ordenacao)
    {
        $buttons_ordenar = '<button type="button" class="dropdown-item ordenar" id="'.$option_ordenacao.'" name="ordenar[]" value="'.$option_ordenacao.'">'.$option_ordenacao.'</button>';

        return $buttons_ordenar;
    }

    public static function buttonsModalCrud($operacao)
    {
        if ($operacao == 'apagar') {
            $buttons_crud = [
                "salvar" => '<button type="button" class="btn btn-danger" id="salvar-apagar">Excluir selecionadas</button>',
                "fechar" => '<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar-modal">Fechar</button>'
            ];
        }

        if ($operacao == 'preparar-editar') {
            $buttons_crud = [
                "salvar" => '<button type="button" class="btn btn-info" id="preparar-editar">Editar selecionada</button>',
                "fechar" => '<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar-modal">Fechar</button>'
            ];
        }

        if ($operacao == 'confirmar-editar') {
            $buttons_crud = [
                "salvar" => '<button type="button" class="btn btn-danger" id="salvar-editar">Confirmar edição</button>',
                "fechar" => '<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar-modal">Fechar</button>'
            ];
        }

        return $buttons_crud;
    }

    public static function buttonsModalNotCrud($tipo)
    {
        if ($tipo == 'alerta') {
            $buttons = [
                "pagina_inicial" => '<button id="recarregar" type="button" class="btn btn-danger" data-dismiss="modal">Voltar para início</button>',
                "fechar_modal" => '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar esta mensagem</button>',
            ];
        }

        if ($tipo == 'response') {
            $buttons = [
                "ok" => '<button type="button" class="btn btn-info response" value="true">Ok</button>',
                "cancelar" => '<button type="button" class="btn btn-warning response" value="false" data-dismiss="modal">Cancelar</button>',
            ];
        }

        return $buttons;
    }
}