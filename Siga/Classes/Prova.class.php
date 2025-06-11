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

    public function getTipo(){
        return 1;
    }

    public function getRecuperacao() {return $this->recuperacao;}

    // sobrescrita de método 
    public function inserir():Bool{
            // montar o sql/ query
            $sql = "INSERT INTO atividade 
                        (descricao, peso, anexo, tipo, recuperacao)
                        VALUES(:descricao, :peso, :anexo, :tipo, :rec)";
            
            $parametros = array(':descricao'=>$this->getDescricao(),
                                ':peso'=>$this->getPeso(),
                                ':anexo'=>$this->getAnexo(),
                                ':tipo' => $this->getTipo(),
                                ':rec' => $this->getRecuperacao());
            
            return Database::executar($sql, $parametros) == true;
    }

    public function alterar():Bool{            
        parent::alterar(); // pai atualiza demais dados
        $sql = "UPDATE atividade
                   SET recuperacao = :recuperacao
                 WHERE id = :id";
          $parametros = array(':id'=>$this->getid(),                         
                              ':recuperacao'=>$this->getRecuperacao());
         return Database::executar($sql, $parametros) == true;
     }



}