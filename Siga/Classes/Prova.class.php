<?php
require_once("Atividade.class.php");

class Prova extends Atividade{
    private $recuperacao;

    public function __construct($id,$desc,$peso,$anexo,$recuperacao){
        parent::__construct($id,$desc,$peso,$anexo);
        $this->setRecuperacao($recuperacao);
    }

    public function setRecuperacao($recuperacao){
        $this->recuperacao = $recuperacao;
       
    }

}