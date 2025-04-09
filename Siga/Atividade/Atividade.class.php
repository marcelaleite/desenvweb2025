<?php

include "../config/config.inc.php";
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
        //abrir conexão com o banco
        $conexao = new PDO(DSN, USUARIO, SENHA);
        // montar o sql/ query
        $sql = "INSERT INTO atividade 
                    (descricao, peso, anexo)
                    VALUES(:descricao, :peso, :anexo)";
        // preparou o comando
        $comando = $conexao->prepare($sql);
        // vincula valores
        $comando->bindValue(':descricao',$this->getDescricao());
        $comando->bindValue(':peso',$this->getPeso());
        $comando->bindValue(':anexo',$this->getAnexo());
        // executar o comando
        return $comando->execute();
    }

    public static function listar($tipo=0, $info=''):Array{
        
        //abrir conexão com o banco
        $conexao = new PDO(DSN, USUARIO, SENHA);
        // montar o sql/ query
        $sql = "SELECT * FROM atividade";
        if ($tipo > 0){
            switch ($tipo){
                case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
                case 2: $sql .= " WHERE descricao like :info ORDER BY descricao"; $info = '%'.$info.'%'; break; // filtro por descrição
            }
        }

        // preparou o comando
        $comando = $conexao->prepare($sql);
        // vincula valores
        if ($tipo > 0)
            $comando->bindValue(':info',$info);
        // executar o comando
        $comando->execute();
        $resultado = $comando->fetchAll();
        return $resultado;
    }

    public function alterar():Bool{
        return true;
    }

}

?>