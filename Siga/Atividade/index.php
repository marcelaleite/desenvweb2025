<?php

include "atividade.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Manutenção de Atividades</h1>
    <form action="atividade.php" method="post">
        <fieldset>
            <legend>Formulário</legend>
            <label for="id">Id:</label>
            <input type="text" name="id" readonly value=<?= isset($atividade)?$atividade['id']:0?>>
            <label for="descricao">Descricao:</label>
            <input type="text" name="descricao" value=<?= isset($atividade)?$atividade['descricao']:''?>>
            <label for="peso">Peso:</label>
            <input type="text" name="peso" value=<?= isset($atividade)?$atividade['peso']:0?>>
            <label for="anexo">Anexo:</label>
            <input type="text" name="anexo" value=<?= isset($atividade)?$atividade['anexo']:''?>>
            <button type="submit" name="acao" value="salvar">Salvar</button>
            <button type="submit" name="acao" value="excluir">Excluir</button>
            <button type="reset" name="acao" value="cancel">Cancelar</button>
        </fieldset>
    </form>
    <!-- Listagem -->
    <h1>Listagem de Atividades</h1>
    <table border="1">
        <th>Id</th>
        <th>Descrição</th>
        <th>Peso</th>
        <th>Anexo</th>
        <?php
            require_once "Atividade.class.php";
          
            $lista = Atividade::listar();
            foreach($lista as $atividade){
                echo "<tr><td><a href='index.php?id={$atividade['id']}'>{$atividade['id']}</a></td><td>{$atividade['descricao']}</td><td>{$atividade['peso']}</td><td>{$atividade['anexo']}</td></tr>";
            }
        ?>
    </table>

</body>
</html>