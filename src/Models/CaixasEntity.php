<?php 

    namespace src\Models;

    class CaixasEntity {

        protected $idCaixa;
        protected $nomeCaixa;
        protected $corCaixa;
        protected $descricaoCaixa;

        /**
         * Get the value of idCaixa
         */ 
        public function getIdCaixa()
        {
                return $this->idCaixa;
        }

        /**
         * Set the value of idCaixa
         *
         * @return  self
         */ 
        public function setIdCaixa($idCaixa)
        {
                $this->idCaixa = $idCaixa;

                return $this;
        }

        /**
         * Get the value of nomeCaixa
         */ 
        public function getNomeCaixa()
        {
                return $this->nomeCaixa;
        }

        /**
         * Set the value of nomeCaixa
         *
         * @return  self
         */ 
        public function setNomeCaixa($nomeCaixa)
        {
                $this->nomeCaixa = $nomeCaixa;

                return $this;
        }

        /**
         * Get the value of corCaixa
         */ 
        public function getCorCaixa()
        {
                return $this->corCaixa;
        }

        /**
         * Set the value of corCaixa
         *
         * @return  self
         */ 
        public function setCorCaixa($corCaixa)
        {
                $this->corCaixa = $corCaixa;

                return $this;
        }

        /**
         * Get the value of descricaoCaixa
         */ 
        public function getDescricaoCaixa()
        {
                return $this->descricaoCaixa;
        }

        /**
         * Set the value of descricaoCaixa
         *
         * @return  self
         */ 
        public function setDescricaoCaixa($descricaoCaixa)
        {
                $this->descricaoCaixa = $descricaoCaixa;

                return $this;
        }
    }