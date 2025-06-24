<?php
require_once ("Database.class.php");
require_once ("Disciplina.class.php");

abstract class Atividade {
    private $id;
    private $descricao;
    private $peso;
    private $anexo;
    private $idDisciplina;
    private $tipo;

    // construtor da classe
    public function __construct($id,$desc,$peso,$anexo, $tipo, $idDisciplina){
        $this->setId($id);
        $this->setDescricao($desc);
        $this->setPeso($peso);
        $this->setAnexo($anexo);
        $this->setIdDisciplina($idDisciplina);
        $this->setTipo($tipo);
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
            throw new Exception("Erro, o ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setIdDisciplina($idDisciplina){
        if ($idDisciplina < 0)
            throw new Exception("Erro, o ID da Disciplina deve ser maior que 0!");
        else
            $this->idDisciplina = $idDisciplina;
    }

    public function setTipo($tipo){
        if ($tipo < 0)
            throw new Exception("Erro, o tipo deve ser maior que 0!");
        else
            $this->tipo = $tipo;
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
    public function getIdDisciplina(): int{
        return isset($this->idDisciplina)?$this->idDisciplina:0;
    }
    public function getTipo(): int{
        return isset($this->tipo)?$this->tipo:0;
    }

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Atuvidade: $this->getId() - $this->getDescricao()
                 - Peso: $this->getPeso()
                 - Anexo: $this->getAnexo()
                 - IdDisciplina: $this->getIdDisciplina()
                 - Tipo: $this->getTipo()";        
        return $str;
    }

    // insere uma atividade no banco 
    abstract public function inserir():Bool;

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
            if ($registro['tipo'] == 1)
                $atividade = new Prova($registro['id'],$registro['descricao'],$registro['peso'],$registro['anexo'], $registro['recuperacao'],$registro['idDisciplina']);
            else
                $atividade = new Trabalho($registro['id'],$registro['descricao'],$registro['peso'],$registro['anexo'],$registro['equipe'],$registro['idDisciplina']);
            array_push($atividades,$atividade);
        }
        return $atividades;
    }

    abstract public function alterar():Bool;

    public function excluir():Bool{
        $sql = "DELETE FROM atividade
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}

?>