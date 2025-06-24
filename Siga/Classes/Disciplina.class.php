<?php

require_once "Database.class.php";
require_once ("Formulario.interface.php");

class Disciplina implements Formulario{

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

    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getId(): int {return $this->id;}
    public function getNome(): String {return $this->nome;}

    //completar com os demais métodos

    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO disciplina 
                    (nome)
                    VALUES(:nome)";
        
        $parametros = array(':nome'=>$this->getNome());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM disciplina";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info ORDER BY nome"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $disciplinas = [];
        while ($registro = $comando->fetch()){
            $disciplina = new Disciplina($registro['id'],$registro['nome']);
            array_push($disciplinas,$disciplina);
        }
        return $disciplinas;
    }

    public function alterar():Bool{       
       $sql = "UPDATE disciplina
                  SET nome = :nome                     
                WHERE id = :id";
         $parametros = array(':id'=>$this->getId(),
                        ':nome'=>$this->getNome());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM disciplina
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}

?>