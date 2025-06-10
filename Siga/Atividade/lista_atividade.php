<?php
session_start();

require_once('../valida_login.php');

    require_once("../Classes/Atividade.class.php");
    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Atividade::listar($tipo, $busca);
    $itens = '';
    foreach($lista as $atividade){
        $item = file_get_contents('itens_listagem_atividades.html');
        $item = str_replace('{id}',$atividade->getId(),$item);
        $item = str_replace('{descricao}',$atividade->getDescricao(),$item);
        $item = str_replace('{peso}',$atividade->getPeso(),$item);
        $item = str_replace('{anexo}',$atividade->getAnexo(),$item);
        $itens .= $item;
    }
    $listagem = file_get_contents('listagem_atividade.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>