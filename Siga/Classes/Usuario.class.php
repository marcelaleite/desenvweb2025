<?php
require_once ("Login.class.php");
require_once ("Database.class.php");

class Usuario{
    private $id;
    private $nome;
    private $email; // login
    private $senha;
    private $matricula;
    private $contato;
    private $login; // objeto login

    // construtor da classe
    public function __construct($id,$nome,$email,$senha, $matricula, $contato){
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setMatricula($matricula);
        $this->setContato($contato);
      //  $this->login->setIdSession(1);
    }

    public function setLogin(Login $login){
        $this->login = $login;
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
        $padrao = "/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (($email == "") && !preg_match($padrao,strtolower($email)))
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
        $str = "Usuario: $this->getId() - $this->getNome() - $this->getEmail()";        
        return $str;
    }

    // insere uma atividade no banco 
    $atividade-
}


?>