<?php
session_start();

    require_once('../valida_login.php');
    require_once("../Classes/Atividade.class.php");
    require_once ("../Classes/Trabalho.class.php");
    require_once("../Classes/Prova.class.php");
    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Atividade::listar($tipo, $busca);
    $itens = '';
    foreach($lista as $atividade){
        if ($atividade->getIdDisciplina()>0)
            $disciplina = Disciplina::listar(1,$atividade->getIdDisciplina())[0];
        $item = file_get_contents('itens_listagem_atividades.html');
        $item = str_replace('{id}',$atividade->getId(),$item);
        $item = str_replace('{descricao}',$atividade->getDescricao(),$item);
        $item = str_replace('{peso}',$atividade->getPeso(),$item);
        $item = str_replace('{anexo}',$atividade->getAnexo(),$item);
        $item = str_replace('{tipo}',get_class($atividade),$item);
        $item = str_replace('{disciplina}',isset($disciplina)?$disciplina->getNome():"",$item);
        $item = str_replace('{recuperacao}',get_class($atividade)=='Prova'?$atividade->getRecuperacao():"",$item);
        $item = str_replace('{equipe}',get_class($atividade)=='Trabalho'?$atividade->getEquipe():"",$item);
        $itens .= $item;
    }
    $listagem = file_get_contents('listagem_atividade.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>