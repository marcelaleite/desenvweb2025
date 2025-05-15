<?php
require_once ("Database.class.php");
class Atividade{
    private $id;
    private $descricao;
    private $peso;
    private $anexo;

    // construtor da classe
    public function __construct($id,$desc,$peso,$anexo){
        $this->id = $id;
        $this->descricao = $desc;
        $this->peso = $peso;
        $this->anexo = $anexo;
    }

    // função / interface para aterar e ler
    public function setDescricao($desc){
        if ($desc == "")
            throw new Exception("Erro, a descrição deve ser informada!");
        else
            $this->descricao = $desc;
    }
    // cada atributo tem um método set para alterar seu valor
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro, a ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setPeso($peso){
            if ($peso < 0)
                throw new Exception("Erro, o peso deve ser maior que 0!");
            else
                $this->peso = $peso;
    }
    // Anexo pode ser em branco por isso o parâmetro é opcional
    public function setAnexo($anexo = ''){
        $this->anexo = $anexo;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getDescricao(): String{
        return $this->descricao;
    }
    public function getPeso(): float{
        return $this->peso;
    }
    public function getAnexo(): String{
        return $this->anexo;
    }

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Atuvidade: $this->id - $this->descricao
                 - Peso: $this->peso
                 - Anexo: $this->anexo";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO atividade 
                    (descricao, peso, anexo)
                    VALUES(:descricao, :peso, :anexo)";
        
        $parametros = array(':descricao'=>$this->getDescricao(),
                            ':peso'=>$this->getPeso(),
                            ':anexo'=>$this->getAnexo());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM atividade";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE descricao like :info ORDER BY descricao"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        //$resultado = $comando->fetchAll();
        $atividades = [];
        while ($registro = $comando->fetch()){
            $atividade = new Atividade($registro['id'],$registro['descricao'],$registro['peso'],$registro['anexo']);
            array_push($atividades,$atividade);
        }
        return $atividades;
    }

    public function alterar():Bool{       
       $sql = "UPDATE atividade
                  SET descricao = :descricao, 
                      peso = :peso,
                      anexo = :anexo
                WHERE id = :id";
         $parametros = array(':id'=>$this->getid(),
                        ':descricao'=>$this->getDescricao(),
                        ':peso'=>$this->getPeso(),
                        ':anexo'=>$this->getAnexo());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM atividade
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}

?>