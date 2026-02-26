<?php 

    namespace src\Models;

    class CaixasEntity {

        protected $idCaixa;
        protected $nomeCaixa;
        protected $corCaixa;
        protected $descricaoCaixa;
        protected $dataHora;
        protected $oldId;

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

        /**
         * Get the value of oldId
         */ 
        public function getOldId()
        {
                return $this->oldId;
        }

        /**
         * Set the value of oldId
         *
         * @return  self
         */ 
        public function setOldId($oldId)
        {
                $this->oldId = $oldId;

                return $this;
        }

        /**
         * Get the value of dataHora
         */ 
        public function getDataHora()
        {
                return $this->dataHora;
        }

        /**
         * Set the value of dataHora
         *
         * @return  self
         */ 
        public function setDataHora($dataHora)
        {
                $this->dataHora = $dataHora;

                return $this;
        }
    }