<?php 

    namespace src\Models;

    class PecasEntity {

        protected $id;
        protected $nome;
        protected $carro;
        protected $descricao;
        protected $preco;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of carro
         */ 
        public function getCarro()
        {
                return $this->carro;
        }

        /**
         * Set the value of carro
         *
         * @return  self
         */ 
        public function setCarro($carro)
        {
                $this->carro = $carro;

                return $this;
        }

        /**
         * Get the value of descricao
         */ 
        public function getDescricao()
        {
                return $this->descricao;
        }

        /**
         * Set the value of descricao
         *
         * @return  self
         */ 
        public function setDescricao($descricao)
        {
                $this->descricao = $descricao;

                return $this;
        }

        /**
         * Get the value of preco
         */ 
        public function getPreco()
        {
                return $this->preco;
        }

        /**
         * Set the value of preco
         *
         * @return  self
         */ 
        public function setPreco($preco)
        {
                $this->preco = $preco;

                return $this;
        }
    }