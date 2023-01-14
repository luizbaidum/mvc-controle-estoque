<!-- Consigo acessar o valor de uma array usando o index como variável -->

<?php 
    if(isset($this->view->dados) && is_array($this->view->dados))
        extract($this->view->dados);
?>