<?php
require_once "Atividade.class.php";

class Prova extends Atividade{
    private $recuperacao;

    public function __construct($id,$desc,$peso,$anexo,$recuperacao,$idDisciplina){
        parent::__construct($id,$desc,$peso,$anexo,$idDisciplina);
        $this->setRecuperacao($recuperacao);
    }

    public function setRecuperacao($recuperacao){
        $this->recuperacao = $recuperacao;
    }


    public function getRecuperacao() {return $this->recuperacao;}

    // sobrescrita de método 
    public function inserir():Bool{
            // montar o sql/ query
            $sql = "INSERT INTO atividade 
                        (descricao, peso, anexo, tipo, recuperacao, idDisciplina)
                        VALUES(:descricao, :peso, :anexo, :tipo, :rec, :idDisciplina)";
            
            $parametros = array(':descricao'=>$this->getDescricao(),
                                ':peso'=>$this->getPeso(),
                                ':anexo'=>$this->getAnexo(),
                                ':tipo' => $this->getTipo(),
                                ':rec' => $this->getRecuperacao(),
                                ':idDisciplina' => $this->getIdDisciplina());
            
            return Database::executar($sql, $parametros) == true;
    }

    public function alterar():Bool{       
        $sql = "UPDATE atividade
                   SET descricao = :descricao, 
                       peso = :peso,
                       anexo = :anexo,
                       recuperacao = :recuperacao,
                       idDisciplina = : i
                       dDisciplina
                 WHERE id = :id";
          $parametros = array(':id'=>$this->getid(),
                         ':descricao'=>$this->getDescricao(),
                         ':peso'=>$this->getPeso(),
                         ':anexo'=>$this->getAnexo(),
                         ':recuperacao'=>$this->getRecuperacao(),
                         ':idDisciplina'=>$this->getIdDisciplina());
         return Database::executar($sql, $parametros) == true;
     }



   

}