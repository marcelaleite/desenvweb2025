<?php
require_once ("Database.class.php");
class Usuario{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $matricula;
    private $contato;

    // construtor da classe
    public function __construct($id,$nome,$email,$senha, $matricula, $contato){
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setMatricula($matricula);
        $this->setContato($contato);
    }

    public function setId($id){
        if ($id < 0)
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        else
            $this->id = $id;
    }

    public function setNome($nome){
        if ($nome == "")
            throw new Exception('Erro. Informe um nome.');
        else
            $this->nome = $nome;
    }

    public function setEmail($email){
        if (($email == "") && !preg_match('\w@\w.\w/i',$email))
            throw new Exception('Erro. Informe um email.');
        else
            $this->email = $email;
    }

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Usuario: $this->getId() - $this->getNome() - $this->getEmail";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO Usuario 
                    (nome, email, senha, matricula, contato)
                    VALUES(:nome, :email, :senha, :matricula, :contato)";
        
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':matricula'=>$this->getMatricula(),
                            ':contato'=>$this->getContato());
        
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