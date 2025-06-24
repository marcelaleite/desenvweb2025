<?php
require_once("Atividade.class.php");

class Trabalho extends Atividade{
    private $equipe;

    public function __construct($id,$desc,$peso,$anexo,$equipe,$idDisciplina){
        parent::__construct($id,$desc,$peso,$anexo,PROVA,$idDisciplina);
        $this->setEquipe($equipe);
    }

    public function setEquipe($equipe){
        $this->equipe = $equipe;
    }


    public function getEquipe() {return $this->equipe;}

    // sobrescrita de método 
    public function inserir():Bool{
            // montar o sql/ query
            $sql = "INSERT INTO atividade 
                        (descricao, peso, anexo, tipo, equipe, idDisciplina)
                        VALUES(:descricao, :peso, :anexo, :tipo, :equipe, :idDisciplina)";
            
            $parametros = array(':descricao'=>$this->getDescricao(),
                                ':peso'=>$this->getPeso(),
                                ':anexo'=>$this->getAnexo(),
                                ':tipo' => $this->getTipo(),
                                ':idDisciplina' => $this->getIdDisciplina(),
                                ':equipe' => $this->getEquipe());
            
            return Database::executar($sql, $parametros) == true;
    }

    public function alterar():Bool{       
        $sql = "UPDATE atividade
                   SET descricao = :descricao, 
                       peso = :peso,
                       anexo = :anexo,
                       equipe = :equipe,
                       tipo = :tipo,
                       idDisciplina = :idDisciplina
                 WHERE id = :id";
          $parametros = array(':id'=>$this->getid(),
                         ':descricao'=>$this->getDescricao(),
                         ':peso'=>$this->getPeso(),
                         ':anexo'=>$this->getAnexo(),
                         ':tipo' => $this->getTipo(),
                         ':idDisciplina' => $this->getIdDisciplina(),
                         ':equipe'=>$this->getEquipe());
         return Database::executar($sql, $parametros) == true;
     }



   

}