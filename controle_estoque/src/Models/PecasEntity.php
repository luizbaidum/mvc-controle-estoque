<?php 

    namespace src\Models;

    class PecasEntity {

        protected $idPeca;
        protected $nomePeca;
        protected $vlrCompraPeca;
        protected $qtdPeca;
        protected $idCaixa;
        protected $fotoPeca;
        protected $oldId;

        /**
         * Get the value of idPeca
         */ 
        public function getIdPeca()
        {
                return $this->idPeca;
        }

        /**
         * Set the value of idPeca
         *
         * @return  self
         */ 
        public function setIdPeca($idPeca)
        {
                $this->idPeca = $idPeca;

                return $this;
        }

        /**
         * Get the value of nomePeca
         */ 
        public function getNomePeca()
        {
                return $this->nomePeca;
        }

        /**
         * Set the value of nomePeca
         *
         * @return  self
         */ 
        public function setNomePeca($nomePeca)
        {
                $this->nomePeca = $nomePeca;

                return $this;
        }

        /**
         * Get the value of vlrCompraPeca
         */ 
        public function getVlrCompraPeca()
        {
                return $this->vlrCompraPeca;
        }

        /**
         * Set the value of vlrCompraPeca
         *
         * @return  self
         */ 
        public function setVlrCompraPeca($vlrCompraPeca)
        {
                $this->vlrCompraPeca = $vlrCompraPeca;

                return $this;
        }

        public function getQtdPeca()
        {
                return $this->qtdPeca;
        }

        /**
         * Set the value of qtdPeca
         *
         * @return  self
         */ 
        public function setQtdPeca($qtdPeca)
        {
                $this->qtdPeca = $qtdPeca;

                return $this;
        }

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
         * Get the value of fotoPeca
         */ 
        public function getFotoPeca()
        {
                return $this->fotoPeca;
        }

        /**
         * Set the value of fotoPeca
         *
         * @return  self
         */ 
        public function setFotoPeca($fotoPeca)
        {
                $this->fotoPeca = $fotoPeca;

                return $this;
        }
    }