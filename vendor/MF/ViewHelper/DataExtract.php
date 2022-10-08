<!-- Consigo acessar o valor de uma array usando o index como variável -->

<?php 
    if(isset($this->array_data) && $this->array_data != null)
        extract($this->array_data);
?>