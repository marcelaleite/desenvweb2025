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
            <input type="text" name="id" readonly >
            <label for="descricao">Descricao:</label>
            <input type="text" name="descricao">
            <label for="peso">Peso:</label>
            <input type="text" name="peso">
            <label for="anexo">Anexo:</label>
            <input type="text" name="anexo">
            <button type="submit" name="salvar" value="salvar">Salvar</button>
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
                echo "<tr><td>{$atividade['id']}</td><td>{$atividade['descricao']}</td><td>{$atividade['peso']}</td><td>{$atividade['anexo']}</td></tr>";
            }
        ?>
    </table>

</body>
</html>