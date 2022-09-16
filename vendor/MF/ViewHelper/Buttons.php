<?php

namespace MF\ViewHelper;

class Buttons {

    public static function buttonsMenu() {
        $buttons_menu = [
            "novo" => '<button class="buttons_menu dropdown-toggle" type="button" id="dropdown-novo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Novo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-novo">
                        <a class="dropdown-item" href="/nova_peca">Peça</a>
                        <a class="dropdown-item" href="/nova_caixa">Caixa</a>
                    </div>',
            "baixar" => '<button id="baixar" class="buttons_menu" value="">Baixar/Uso</button>',
            "apagar" => '<button class="buttons_menu dropdown-toggle" type="button" id="dropdown-apagar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Apagar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-apagar">
                            <a class="dropdown-item" href="#">Peça</a>
                            <a class="dropdown-item" href="#">Caixa</a>
                        </div>',
            "editar" => '<button class="buttons_menu dropdown-toggle" type="button" id="dropdown-editar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Editar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-editar">
                            <a class="dropdown-item" href="#">Peça</a>
                            <a class="dropdown-item" href="#">Caixa</a>
                        </div>',
        ];

        return $buttons_menu;
    }

    public static function buttonsCrud() {
        $buttons_crud = [
            "salvar" => '<button id="salvar" type="submit" class="buttons_crud">Salvar</button>',
			"cancelar" => '<button id="cancelar" class="buttons_crud">Cancelar/Voltar</button>',
        ];

        return $buttons_crud;
    }

    //confirmar como faz ordenação
    public static function ordenar($option_ordenacao) {
        $buttons_ordenar = '<button type="button" class="dropdown-item" id="'.$option_ordenacao.'" name="'.$option_ordenacao.'" value="'.$option_ordenacao.'">'.$option_ordenacao.'</button>';
        return $buttons_ordenar;
    }
}