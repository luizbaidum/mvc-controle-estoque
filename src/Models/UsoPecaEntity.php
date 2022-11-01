<?php 

namespace src\Models;

class UsoPecaEntity {

    protected $idUso;
    protected $idPeca;
    protected $qtdUso;
    protected $dataUso;
    protected $dataHora;

    /**
     * Get the value of idUso
     */ 
    public function getIdUso()
    {
            return $this->idUso;
    }

    /**
     * Set the value of idUso
     *
     * @return  self
     */ 
    public function setIdUso($idUso)
    {
            $this->idUso = $idUso;

            return $this;
    }

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
     * Get the value of qtdUso
     */ 
    public function getQtdUso()
    {
            return $this->qtdUso;
    }

    /**
     * Set the value of qtdUso
     *
     * @return  self
     */ 
    public function setQtdUso($qtdUso)
    {
            $this->qtdUso = $qtdUso;

            return $this;
    }

    /**
     * Get the value of dataUso
     */ 
    public function getDataUso()
    {
            return $this->dataUso;
    }

    /**
     * Set the value of dataUso
     *
     * @return  self
     */ 
    public function setDataUso($dataUso)
    {
            $this->dataUso = $dataUso;

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