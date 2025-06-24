<?php
require_once ("Usuario.class.php");
require_once ("Database.class.php");
class Login{
    private $idSession;
    public function setIdSession($session){
        $this->idSession = $session;
    }
    public static function efetuarLogin($login, $senha){
        if ($login != ""  && $senha != ""){
            $sql = "SELECT * FROM usuario
                     WHERE email = :login AND senha = :senha ";
            $parametros = array(":login"=> $login, 
                                ":senha"=> $senha);    
            try{
                $resultado = Database::executar($sql,$parametros);
                $dados = $resultado->fetch();
                if ($dados){
                    return new Usuario($dados['id'],
                                           $dados['nome'],
                                           $dados['email'],
                                           $dados['senha'],
                                           $dados['matricula'],
                                           $dados['contato']);
                }else
                    return false;
            }catch (PDOException $e ){
                throw new Exception("Erro ao consultar dados, verifique os dados informados.");
            }
        }else 
            throw new Exception("Informe um usuário e senha válidos");
    }
}