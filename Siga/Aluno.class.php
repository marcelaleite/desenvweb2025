<?php
class Aluno{
    private $id;
    private $nome;
    private $cpf;
    private $usuario;
    private $senha;

    // private: privado - somente a classe tem acesso
    // public: publivo - todos tem acesso
    // protected: protegido - somente a classe e filhas tem acesso

    // definir o construtor do objeto
    // para construir o objeto com um estado inicial
    /**
     * *
     * @param int $id - chave primária
     * @param string $nome - nome do aluno
     * @param string $cpf - informar o cpf - campo único
     * @param string $usuario - usuario para fazer login
     * @param string $senha - senha de acesso ao sistema

     */
    public function __construct($id, $nome, $cpf, $usuario, $senha){
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    // são comportamento da classe / aquilo que o objeto faz/ 
    public function fazerLogin($usuario, $senha):Bool{
        return $usuario == $this->usuario && $this->senha == $senha;

    }
}

?>