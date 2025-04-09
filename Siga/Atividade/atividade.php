<?php
require_once("Atividade.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = isset($_POST['id'])?$_POST['id']:0;
    $descricao = isset($_POST['descricao'])?$_POST['descricao']:"";
    $peso = isset($_POST['peso'])?$_POST['peso']:0;
    $anexo = isset($_POST['anexo'])?$_POST['anexo']:"";

    $atividade = new Atividade($id,$descricao,$peso,$anexo);

    if ($id > 0)
        $resultado = $atividade->alterar();
    else
        $resultado = $atividade->inserir();

    if ($resultado)
        header("Location: index.php");
    else
        echo "Erro ao salvar dados: ". $atividade;
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){

    $id = isset($_GET['id'])?$_GET['id']:0;
    $resultado = Atividade::listar(1,$id);
    if ($resultado)
        $atividade = $resultado[0];

}
?>