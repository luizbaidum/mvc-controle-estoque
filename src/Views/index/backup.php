<h4>Página inicial</h4>

<hr>

<?php foreach($this->view->menu as $indice => $menu) { ?>

<ul>
	<li>ID: <?= $indice['a']?></li>
</ul>
	
<?php } ?>	

<?php foreach($this->view->dados as $indice => $produto) { ?>

	<ul>
		<li>ID: <?= $produto['id']?></li>
		<li>NOME: <?= $produto['nome']?></li>
		<li>DESCRIPTION: <?= $produto['descricao']?></li>
		<li>CAR: <?= $produto['carro']?></li>
		<li>PRICE: R$ <?= $produto['preco']?></li>
	</ul>
		
<?php } ?>	