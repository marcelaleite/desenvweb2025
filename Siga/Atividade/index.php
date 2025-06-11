<?php
session_start();

require_once('../valida_login.php');

require_once("../Classes/Prova.class.php");
require_once("../Classes/Atividade.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = isset($_POST['id'])?$_POST['id']:0;
    $descricao = isset($_POST['descricao'])?$_POST['descricao']:"";
    $peso = isset($_POST['peso'])?$_POST['peso']:0;
    $tipo = isset($_POST['tipo'])?$_POST['tipo']:0;
    $recuperacao = isset($_POST['recuperacao'])?$_POST['recuperacao']:0;
    $equipe = isset($_POST['equipe'])?$_POST['equipe']:0;
    $acao = isset($_POST['acao'])?$_POST['acao']:"";

    $destino_anexo = 'uploads/'.$_FILES['anexo']['name'];
    move_uploaded_file($_FILES['anexo']['tmp_name'],PATH_UPLOAD.$destino_anexo);
    
    if ($tipo == 1)
        $atividade = new Prova($id,$descricao,$peso,$destino_anexo, $recuperacao);
    else // corrigir abaixo para criar um trabalho em vez de uma atividade
        $atividade = new Atividade($id,$descricao,$peso,$destino_anexo);
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
    $formulario = file_get_contents('form_cad_atividade.html');

    $id = isset($_GET['id'])?$_GET['id']:0;
    $resultado = Atividade::listar(1,$id);
    if ($resultado){
        $atividade = $resultado[0];
        $formulario = str_replace('{id}',$atividade->getId(),$formulario);
        $formulario = str_replace('{descricao}',$atividade->getDescricao(),$formulario);
        $formulario = str_replace('{peso}',$atividade->getPeso(),$formulario);
        $formulario = str_replace('{anexo}',$atividade->getAnexo(),$formulario);
        $formulario = str_replace('{tipo}',"",$formulario);
        $formulario = str_replace('{recuperacao}',"",$formulario);
        $formulario = str_replace('{equipe}',"",$formulario);
    }else{
        $formulario = str_replace('{id}',0,$formulario);
        $formulario = str_replace('{descricao}','',$formulario);
        $formulario = str_replace('{peso}','',$formulario);
        $formulario = str_replace('{anexo}','',$formulario);

        $formulario = str_replace('{tipo}',"",$formulario);
        $formulario = str_replace('{recuperacao}',"",$formulario);
        $formulario = str_replace('{equipe}',"",$formulario);
    }
    print($formulario); 
    include_once('lista_atividade.php');
 

}
?>