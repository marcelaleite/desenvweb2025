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


    public function setSenha($senha){
        if ($senha == "") // regras para senha
            throw new Exception('Erro. Informe uma senha válida.');
        else
            $this->senha = $senha;
    }

    public function setMatricula($matricula){
        if ($matricula == "") // regras para matricula
            throw new Exception('Erro. Informe uma matricula válida.');
        else
            $this->matricula = $matricula;
    }

    public function setContato($contato){
        if ($contato == "") // regras para contato
            throw new Exception('Erro. Informe um contato válida.');
        else
            $this->contato = $contato;
    }

    public function getId(){return $this->id;}
    public function getNome(){return $this->nome;}
    public function getEmail(){return $this->email;}
    public function getSenha(){return $this->senha;}
    public function getMatricula(){return $this->matricula;}
    public function getContato(){return $this->contato;}

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
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE matricula = :info ORDER BY id"; break; // filtro por matricula
            case 3: $sql .= " WHERE nome like :info ORDER BY descricao"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()){
            $usuario = new Usuario($registro['id'],$registro['nome'],$registro['email'],$registro['senha'],$registro['matricula'],$registro['contato']);
            array_push($usuarios,$usuario);
        }
        return $usuarios;
    }

    public function alterar():Bool{       
       $sql = "UPDATE usuario
                  SET nome = :nome, 
                      email = :email,
                      senha = :senha,
                      matricula = :matricula,
                      contato = :contato
                WHERE id = :id";
         $parametros = array(':id'=>$this->getId(),
                        ':nome'=>$this->getNome(),
                        ':email'=>$this->getEmail(),
                        ':senha'=>$this->getSenha(),
                        ':matricula'=>$this->getMatricula(),
                        ':contato'=>$this->getContato());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM usuario
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}


?>