<?php
class Disciplina{

    private $id;
    private $nome;
    private $atividades;

    public function __construct($id, $nome){
        $this->setId($id);
        $this->setNome($nome);
        $this->atividades = array();
    }

    public function addAtividade(Atividade $atividade){
        array_push($this->atividades,$atividade);
    }

    //completar com os demais métodos
}

?>