<?php
session_start();

require_once('../valida_login.php');
    require_once("../Classes/Disciplina.class.php");
    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Disciplina::listar($tipo, $busca);
    $itens = '';
    foreach($lista as $disciplina){
        $item = file_get_contents('itens_listagem_disciplina.html');
        $item = str_replace('{id}',$disciplina->getId(),$item);
        $item = str_replace('{nome}',$disciplina->getNome(),$item);
        $itens .= $item;
    }
    $listagem = file_get_contents('listagem_disciplina.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>