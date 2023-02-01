# mvc-controle-estoque

Este projeto em arquitetura MVC, usando PHP, Ajax (Jquery), CSS e HTML trata-se do atendimento ao pedido do meu mecânico preferido para ajuda-lo a controlar seu estoque de peças.

O "cliente" guarda peças automotivas em Caixas de papelão.

Por enquanto não pretendo inserir APIs p/ ler códigos de barra ou pesquisar Notas Fiscais, então os lançamentos CRUDs de peças e caixas será feito a mão.
Pretendo deixar esta atividade intuitiva, rápida e fácil.

> Objetivos e ideias p/ o sistema:
- [x] CRUD peças e caixas
- [x] registro data/hora de insert e update
- [x] pesquisa e ordenação
- [x] busca sql por keydown ao digitar nome de nova peça
- [ ] valor financeiro do estoque
- [ ] registro do valor cobrado pela peça
- [ ] registro de NF da peça (data, cnpj)
- [ ] alinhar infos relevantes das peças e caixas c/ cliente
- [x] script de upload de imagens
- [x] table e tratamento p/ imagens
- [x] alterar alert de confirm de crud p/ modalzinho
- [x] tentar dinamizar o form submetido
- [x] arrumar o modal de listagem de caixas p/ como sendo listagem de caixas
- [x] coluna qtd de peças.
- [ ] repassar codigo e buscar mais padronização
- [x] adicionar letras p/ ID de caixas e pecas
- [ ] exibir caixas cadastradas
- [x] remover obrigatoriedade de lançar valor pago
- [ ] transformar echo $e->getMessage() em um arquivo de log?? >> trabalha-las p/ dar retorno mais especifico de erro p/ usuario
- [ ] revisar todo o sistema p/ melhoria de distribuição de arquivos e classes
