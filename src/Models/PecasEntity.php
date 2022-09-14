<?php 

    namespace src\Models;

    class PecasEntity {

        protected $idPeca;
        protected $nomePeca;
        protected $vlrCompraPeca;
        protected $caixaPeca;

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

        /**
         * Get the value of caixaPeca
         */ 
        public function getCaixaPeca()
        {
                return $this->caixaPeca;
        }

        /**
         * Set the value of caixaPeca
         *
         * @return  self
         */ 
        public function setCaixaPeca($caixaPeca)
        {
                $this->caixaPeca = $caixaPeca;

                return $this;
        }
    }