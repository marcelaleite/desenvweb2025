<?php
require_once("Atividade.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = isset($_POST['id'])?$_POST['id']:0;
    $descricao = isset($_POST['descricao'])?$_POST['descricao']:"";
    $peso = isset($_POST['peso'])?$_POST['peso']:0;
    $anexo = isset($_POST['anexo'])?$_POST['anexo']:"";
    $acao = isset($_POST['acao'])?$_POST['acao']:"";

    $atividade = new Atividade($id,$descricao,$peso,$anexo);
    if ($acao == 'salvar')
        if ($id > 0)
            $resultado = $atividade->alterar();
        else
            $resultado = $atividade->inserir();
    elseif ($acao == 'excluir')
        $resultado = $atividade->excluir();

    if ($resultado)
        header("Location: index.php");
    else
        echo "Erro ao salvar dados: ". $atividade;
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){

    $id = isset($_GET['id'])?$_GET['id']:0;
    $resultado = Atividade::listar(1,$id);
    if ($resultado)
        $atividade = $resultado[0];


    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Atividade::listar($tipo, $busca);

}
?>