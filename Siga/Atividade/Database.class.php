<?php
include "../config/config.inc.php";

class Database{
    public static function abrirConexao(){
        try{
            return new PDO(DSN, USUARIO, SENHA);
        }catch(PDOException $e){
            echo "Erro ao conectar com o banco de dados: ".$e->getMessage();
        }
    }
    public static function preparar($sql){
        $conexao = self::abrirConexao();
        return $conexao->prepare($sql);
    }
    public static function vincularParametros($comando,$parametros){
        foreach($parametros as $chave=>$valor)
            $comando->bindValue($chave,$valor);
        return $comando;
    }
    public static function executar($sql, $parametros){
        $comando = self::preparar($sql);
        $comando = self::vincularParametros($comando,$parametros);
        $comando->execute();
        return $comando;
    }
}
?>